# Deploying to cPanel via GitHub Actions (CI/CD)

Goal: every `git push` to `main` automatically syncs the project files to your cPanel hosting — no manual FTP upload needed.

## Why SSH?

GitHub Actions runs on a temporary cloud server (not your computer, not your hosting). For it to put files onto your cPanel server, it needs a way to log in to that server remotely and copy files over.

SSH (Secure Shell) is used because:

- **It's secure.** The connection is encrypted, so files and credentials aren't sent in plain text (unlike plain FTP).
- **It supports key-based login.** Instead of storing your cPanel password in GitHub, you authorize a key pair — GitHub holds the private key (as a secret), your server holds the matching public key. No password is ever transmitted or stored.
- **It enables `rsync`.** Tools like `rsync` run over SSH and only transfer files that changed, which is fast and avoids re-uploading everything on every deploy.
- **It's widely supported.** Most cPanel hosts offer SSH access as a standard feature, making it the most reliable automation method (compared to cPanel's Git Version Control UI, which is more limited and harder to automate).

In short: SSH is the secure "door" GitHub Actions uses to reach your server and drop off the updated files.

## Steps

### 1. Get SSH details from cPanel
cPanel → **SSH Access** → note your **host/IP**, **port**, and **username**.

### 2. Generate an SSH key pair
```
ssh-keygen -t ed25519 -f cpanel_deploy_key -N ""
```
This creates two files:
- `cpanel_deploy_key` — the **private** key (keep secret, goes into GitHub)
- `cpanel_deploy_key.pub` — the **public** key (goes into cPanel)
ssh-keygen -m PEM -t rsa -b 4096 -f ~/.ssh/github_actions2 -N ""
to test it ssh -p 21098 -i ~/.ssh/github_actions2 jeribhfg@66.29.141.181
### 3. Authorize the public key in cPanel
cPanel → **SSH Access** → **Manage SSH Keys** → **Import Key** → paste `cpanel_deploy_key.pub` contents → **Authorize**.

### 4. Push your project to GitHub

**a. Initialize git locally (if not already done):**
```
git init
git branch -M main
```

**b. Create a `.gitignore`** so secrets and local-only files aren't pushed:
```
.env
*.log
```

**c. Create the GitHub repo.**
Either on github.com (New Repository), or via the CLI:
```
gh repo create cpaneltest --private --source=. --remote=origin
```

**d. Stage, commit, and push:**
```
git add .
git commit -m "Initial commit"
git push -u origin main
```

After this, your code lives on GitHub, and every future `git push` to `main` is what will trigger the deploy workflow.

### 5. Add GitHub Secrets
Repo → **Settings → Secrets and variables → Actions**, add:

| Secret name | Value |
|---|---|
| `SSH_PRIVATE_KEY` | contents of `cpanel_deploy_key` | the private key
| `SSH_HOST` | your cPanel host | - the server ip
| `SSH_USERNAME` | your cPanel username |
| `SSH_PORT` | your SSH port |
| `REMOTE_TARGET` | e.g. `/home/youruser/public_html/` |
                        /home/jeribhfg/public_html/
### 6. Create the workflow file

In your project, create the folders/file: `.github/workflows/deploy.yml`

Paste this in:

```yaml
name: Deploy to cPanel

on:
  push:
    branches:
      - main

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout code
        uses: actions/checkout@v4

      - name: Deploy via rsync over SSH
        uses: easingthemes/ssh-deploy@v6
        with:
          SSH_PRIVATE_KEY: ${{ secrets.SSH_PRIVATE_KEY }}
          REMOTE_HOST: ${{ secrets.SSH_HOST }}
          REMOTE_USER: ${{ secrets.SSH_USERNAME }}
          REMOTE_PORT: ${{ secrets.SSH_PORT }}
          TARGET: ${{ secrets.REMOTE_TARGET }}
          ARGS: "-avzr --delete"
          EXCLUDE: "/.git/, /.github/, /.gitignore, /.env"
```

What each part means:
- `on: push: branches: [main]` — run this workflow every time someone pushes to `main`.
- `actions/checkout@v4` — pulls your repo's code into the GitHub Actions runner so it has something to deploy.
- `easingthemes/ssh-deploy@v5` — a prebuilt action that connects over SSH and runs `rsync` to copy files to your server.
- `SSH_PRIVATE_KEY`, `REMOTE_HOST`, `REMOTE_USER`, `REMOTE_PORT`, `TARGET` — pulled from the GitHub Secrets you created in step 5, so no credentials are hardcoded in the file.
- `ARGS: "-avzr --delete"` — rsync flags: archive mode, verbose, compress, recurse into folders, and delete files on the server that no longer exist in the repo (keeps server in sync, not just additive).
- `EXCLUDE` — files/folders that should never be uploaded (git internals, workflow files, and your `.env` with secrets — that should be created manually on the server instead, not committed to GitHub).

Commit and push this file:
```
git add .github/workflows/deploy.yml
git commit -m "Add auto-deploy workflow"
git push
```

### 7. Push and verify

1. Go to your GitHub repo → **Actions** tab. You should see the "Deploy to cPanel" workflow running (a yellow dot → green check when done).
2. Click into the run to see live logs of the SSH connection and file transfer.
3. If it's green, check your site — the files should now match what you pushed.
4. If it fails, click the failed step to read the error. Common issues:
   - **Permission denied (publickey)** — the public key wasn't authorized correctly in cPanel, or the wrong private key is in `SSH_PRIVATE_KEY`.
   - **Connection timed out** — wrong `SSH_HOST` or `SSH_PORT`, or your host blocks external SSH connections (some budget hosts do — contact support to confirm SSH is enabled for your account).
   - **rsync: command not found** — rare, but some minimal hosting environments don't have `rsync` installed; you'd need to ask your host to install it or switch to an SCP/FTP-based action instead.

Once a run finishes green, automatic deployment is fully working: from then on, every `git push` to `main` updates your live cPanel site with no manual upload needed.


for error database 
If that file doesn't exist there, check the account-wide log instead:

bash
find ~ -name "error_log" -newer ~/public_html/index.php

or simply:

bash
tail -50 /home/jeribhfg/logs/jericogarcia.site.error.log