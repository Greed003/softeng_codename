## For Database Setup
composer run db-setup

## For Software Testing Use this Command
composer test

## For Pull Request
git branch -M test \
git remote add origin https://github.com/Greed003/softeng_codename.git \
git pull origin test

## For Push Request
git add . \
git commit -m "first commit" \
git push -u origin test