Examined subdomain deployment workflow adjustments
Examined subdomain deployment workflow adjustments
If you go with a subdomain instead of a subfolder, the process is almost identical to what you already did — only one value changes.

1. Create the subdomain in cPanel first (if you haven't yet):
cPanel → search "Subdomains" → fill in name (e.g. shop) + domain (jericogarcia.site) → cPanel shows you the Document Root it creates, typically:

/home/jeribhfg/public_html/shop.jericogarcia.site/
(Note it exact path — sometimes cPanel names it slightly differently.)

2. Set up a new GitHub repo for this new/different project (separate from your dashboard app repo).

3. Add the same 5 secrets to that new repo — most values are identical to before since it's the same server/account, only REMOTE_TARGET differs:

Secret	Value
SSH_PRIVATE_KEY	same private key as before (cat ~/.ssh/github_actions)
SSH_HOST	66.29.141.181 (same)
SSH_USERNAME	jeribhfg (same)
SSH_PORT	21098 (same)
REMOTE_TARGET	/home/jeribhfg/public_html/shop.jericogarcia.site/ ← this is the only different one
4. Add the same deploy.yml to this new repo (same content, same action easingthemes/ssh-deploy@v5.1.0), just with the updated REMOTE_TARGET above.

5. Push to main — it deploys independently to that subdomain's folder, completely separate from your dashboard app.

Result: the new project becomes live at:

shop.jericogarcia.site
while jericogarcia.site (root) keeps running your existing dashboard app, untouched.

Since you can reuse the exact same SSH key pair across as many projects/repos as you want (it's tied to the server account, not to a specific site), you don't need to generate a new key each time — just reuse SSH_PRIVATE_KEY's value in each new repo's secrets.

Want to go create the subdomain now and tell me the exact Document Root it gives you, so we lock in the right REMOTE_TARGET?