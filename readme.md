<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

## Assignment

We're going to build a blog from scratch with an admin panel. This blog will have some features that we've already build but also some features we will dive in. The idea behind the blog is that you get to build a full application from scratch where you can keep extending what you're already done. 

We will focus on the frontend side of Laravel, mostly Blade. We will send out a monthly newsletter with the most recent published blog posts and we will be able to schedule blog posts for the future. 

Each step below here is needed to get to our final product. You have to start with step one and build upon that. To get started I've setup this repository with just a blank project and I've run `php artisan make:auth` for you. The rest is up to you based on the building steps. Just like the other project, we can just run `make init` to setup our project. 

Design is all up to you! Laravel comes by default with [Bootstrap 4](https://getbootstrap.com/docs/4.2/getting-started/introduction/)

### Build a blog with posts on the homepage with standard pagination.

The blog we're going to build has posts. Each post has a title and a body and an author (user) for now. You have to build the controller, the routing, the migration, the seeder, the view and so on to get everything displayed on the homepage. Finally I want you to add pagination on the homepage. Let's say maximum of 5 posts per page.

The post on the homepage should show the title, a summary of the body and the author name. We will add more stuff to it later.

> Documentation: https://laravel.com/docs/5.7/pagination

### Single blog post

Now we need to add a link to the current blog post so that we can show the single blog. This page holds the same kind of content for now, except all the other posts. 

I want you to use a slug in the url instead of the id. So the url should like look like this [http://localhost:8080/blog/my-awesome-blog](http://localhost:8080/blog/my-awesome-blog).    

> Documentation: https://laravel.com/docs/5.7/routing#implicit-binding

### A blog can have comments

So a blog without comments is no fun! So a post can have many comments. A comment can only be added by someone who is logged in. A comment also has an author and a body. So in this case a comment is always connected to a post and a user.

Finally you need to display all the comments on the single page. A comment displays the body, the author name and the date it was posted. 

On the homepage I want to see the number of comments per blog item. I also want to see this number on the single post page.

> Documentation: https://laravel.com/docs/5.7/eloquent-relationships#counting-related-models

### A blog post can be published

Since a blog post can be published we need to make sure that it has a date for that. We can use the `published_at` field for that in our posts table. 

The homepage should only display the posts that are published. So when the published_at date is set in the past. If it's set in the future, it's scheduled for a later date to be published. If there is no date at all it's not published yet. 

> Documentation: https://laravel.com/docs/5.7/eloquent-mutators#date-mutators

### Automated news letter

Laravel offers the functionality to build commands that we can call on different places. In this case we just want to have a command to send out a newsletter with the latest published blogs.

This command should look like this `php artisan newsletter:monthly`. This command will fetch all posts that have been published the last month. The links to these posts should be put in an email to all users in the system.

Remember that mailhog is setup, so if you visit [http://localhost:8025](http://localhost:8025) you should see any emails that are send.

> Documentation: https://laravel.com/docs/5.7/artisan

> Documentation: https://laravel.com/docs/5.7/mail 

### Sidebar

A blog is nothing without a sidebar. We need to adjust the templates to always have a sidebar for all pages. The most important thing here is to reuse partials in the applications and to have an understanding about that.

The sidebar should contain the 5 posts with the most comments.   

> Documentation: https://laravel.com/docs/5.7/blade

> Documentation: https://laravel.com/docs/5.7/blade#service-injection

### Admin panel for posts

We've been using seeders so far to create content and comments. Let's now change that by creating an admin functionality where only a user with admin set to true in the users table is manager to create, edit, delete posts.

Whenever we delete a post we want to make sure the post isn't actually deleted, but marked as deleted.

> Documentation: https://laravel.com/docs/5.7/authorization

> Documentation: https://laravel.com/docs/5.7/eloquent#soft-deleting

### Admin panel for comments

We can now manager posts, but we also want to manage comments. Since we don't want to change the opinions of our readers we just want to be able to view all comments or delete them. We can't edit them or create the from the admin panel.

Whenever we delete a comment we want to make sure the comment isn't actually deleted, but marked as deleted.

### Publishing posts

We can set the published_at column int he database right now to publish a post, but there is no admin functionality for it yet. I want you to create the functionality to publish a post. You can do that in the edit functionality of a post or use a separate page for that.

###  Uploading images

Our blog is now just text! Let's change that by adding some images to a blog. Jut a feature image for now. The feature image should be uploadable in the admin panel and should be stored in the public disk and the local driver, see the documentation for more info.

> Documentation: https://laravel.com/docs/5.7/filesystem 

### Tests!

Write tests for everything we've build so far! This is a huge job to get done. Good luck!
