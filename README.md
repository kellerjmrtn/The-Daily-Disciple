<p align="center"><a href="https://thedailydisciple.net" target="_blank"><img src="https://www.thedailydisciple.net/assets/devotion-logo-large.png" width="250" alt="The Daily Disciple Logo"></a></p>

<h1 align="center">
The Daily Disciple
</h1>

The Daily Disciple is a daily devotional for everyone located at https://www.thedailydisciple.net. Every day, we post a short passage that we hope uplifts and supports each reader in their journey through life.

# Technical Details

## Code

For this project, I chose to use Laravel as it is highly customizable and I am deeply familiar with Laravel from my professional experience. Given that this is a simple blog site, a CMS would almost certainly have been a more streamlined solution, but I chose Laravel for practice, ease of customizability, and ultimately, an enjoyable developer experience

Most of this project is super basic Laravel. A `Devotion` model, a `DevotionController` with basic CRUD methods, a `DevotionPolicy` for CRUD permissions, a few custom `Request` classes for form validation, simple Laravel Breeze authentication, and some custom JavaScript and CSS make up the majority of this project. There are however, a few highlights worth sharing

### Dependency Injection

When including a Bible verse, the site automatically generates a 3rd party link for it. For this, I've created a `VerseLinkGenerator` interface which is registered to an implementation in my `AppServiceProvider`. This way, I can easily swap out link generation logic with another implementation if necessary. Even if I never outright swap it to a brand new implementation, it forces link generation logic to stay separate, which increases cleanliness and maintainability

### Service Classes

I like to keep my controllers as small as possible, and put logic in "service" classes, like the `DevotionService`. I then hand my controllers an instance of `DevotionService` to execute business logic. This has a few advantages
1. Separation of concerns - the methods on my service classes take in as little input as necessary, do one thing, and return the result. This keeps my code from ballooning
2. Reusability - later on down the line, I may want to reuse this logic in an API, or in a cron job, or any other non-web use case. If all my logic is separated, this is incredibly easy to do
3. Testability - although this is a simple personal project and I haven't written any tests, I *love* testable code, and believe all code should be written with testability in mind. A (properly written) service class is so much easier to test than HTTP Controller logic

### Trusted Proxies

My stack includes both Cloudfront and an Elastic Load Balancer, which, as reverse proxies, overwrite the incoming request IP and append the previous IP to the `X-Forwarded-For` header. Laravel conveniently provides a `TrustProxies` middleware to handle this. However, the documented "trust all proxies" solution--using a `"*"`--only trusts a single proxy layer, while mine has two. After some googling, I found a solution--using `"0.0.0.0/0"` instead--which admittedly makes a lot of sense

### Design

I made this design up from scratch, to see what I could do. If I had to pick one element on the design that I'm most proud of, it would be the mobile version of the devotional cards. Here is a quick video demo 

## Server & Hosting

Given the Laravel stack, my two other requirements were
1. AWS Hosted, and
2. Low cost and simple

There are other lower cost products, and other lower cost architectures within AWS itself (particularly S3 + DynamoDB + Lambda), but the following solution was low cost *enough* that it works for me

### Stack
1. Route 53 DNS
2. Cloudfront
3. Elastic Load Balancing
4. EC2 (t2.micro)
5. LAMP

Perhaps most notably, I omitted RDS as a cost saving measure, and instead am running MariaDB on the EC2 itself. I figured this would be worth the effort for a simple personal project

### EBS

How was I going to resolve the lack of RDS with the ephemeral nature of an EC2 Instance? I came up with the following solution:
1. All data--including site files, MariaDB databases, and backups--is stored on a separate, non-root EBS volumne. This means I can terminate and instantiate a new EC2 instance, and not lose my data
2. A nightly cron script runs a `mysqldump` and saves the output to the EBS. While not perfect, this is a satisfactorily strong backup policy for my use case
3. I've created a custom AMI which contains preconfigured MariaDB, Apache, and PHP environments, the aforementioned cron configuration, and symlinks to the relevant data in the non-root EBS. This makes creating a new web server easier than I was even expecting. I simply must instantiate a new EC2 with the AMI, attach the EBS to it, and add it to the ELB's target group. Within a couple minutes, I can complely rebuild my environment. While this wouldn't fulfill professional uptime obligations, it's remarkably easy and low cost and is the perfect solution for me

# Conclusion

This was a fun project for me. As always, there are a million things I could've done better with more time, and if the project continues, maybe I'll get to do them! For now, I'm satisfied with what it is and proud of my work. Please check it out at https://www.thedailydisciple.net!