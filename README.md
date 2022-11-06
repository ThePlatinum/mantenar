<img src="public/images/Mantener%20Arch%20Design.png" alt="Mantenar Logo">



<p align="left" style="padding-top:30px"><a href="https://mantenar.com" target="_blank"><img src="public/images/mantenar_logo.svg" width="400" alt="Mantenar Logo"></a></p>

## Inspiration
Organizations are in constant need to share files with their pool of staff and clients, and while there are lots of tools available to do just that, many if not all of them require the file transfer to happen on servers that are not controlled by the organization.
This is a concern, especially for startups. They sometimes can not keep track of files sent over emails or chat platforms.

## About
<a href="https://mantenar.com" target="_blank"><img src="public/images/mantenar.svg" alt="Mantenar Icon" height='40px'></a>

**Mantener** is a simple file management system for organizations to maintain file share with their staffs.

## What it does
Mantenar gives startups the space to host their files and manage them on their self-owned server is a great fit. This will ensure no need to transfer files to places beyond their control, or unnecessary use of paper in printing documents for local storage.
With the features to decide who should have access to a file or not, amazingly UNLIMITED file transfer size limit or storage cap, Mantenar gives power to its users.
Mantenar can be EASILY installed on any server with a simple 'get started' process.

## Features
- Simple, Fast File Sharing Management
- Role Based User Management
- Multiple File type support
- Real time chat/comment on file shares

## Setting up Mantenar
- Clone/Download/Fork the repo
- Run `composer install`
- Run `cp .env.example .env`
- Edit the `.env` file accordingly \
  Note:
    - Database connection must be to a singlestore db instance
    - Must set email details
- Run `php artisan key:generate`
- Run `php artisan migrate --force`
- Run `php artisan serve` to start the application
- Run `php artisan websocket:serve` to start the websocket server
- Check how to use [here](https://mantenar.com/how) \
**To use the [Mantenar Demo](https://app.mantenar.com) you can use this url to reset mantenar configuration to a fresh installation: https://app.mantenar.com/migrar/7014293952**

## What's next for Mantenar
Mantenar will grow into a large suite of Management Tools for Startups, more features that will be added to Mantenar includes:
- Improved User Interaction and Content
- Settings Page(s)
- A Super Admin Account for more 'Admin' Features
- Team Share
- Google Drive, FTP, FileZilla Integration
- Allowing File Viewers with no Accounts (for sharing files with clients who don't need to be logged in)
- Disable/Enable Download Option
- Temporary File Access
- Auto Deleting Files
- A Mobile App for full customization
- Error/Performance Monitoring
- Private Staff Account Email System
- SAAS Version

## How we built it
Mantenar is built with PHP using the Laravel 9 framework, Javascript, HTML and CSS and plugins like jQuery and bootstrap. With SingleStoreDB powering the Application.

## Accomplishments that we're proud of
Of all the already implemented features of Mantener, I am more proud of the 'live chat', I was able to implement this without using any NPM package and that was awesome because there aren't many resources available on how to do that.

## Non Default Packages used
- laravel/ui
- jQuery
- bootstrap
- multi-select
- bootbox
- boxicon

## License
Mantenar is open-sourced and licensed under the [MIT license](https://opensource.org/licenses/MIT).

