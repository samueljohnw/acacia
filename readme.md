# Acacia Platform

The Acacia platform was built for a non-profit to help other non-profits and missionaries receive donations with ease. 

This platform has an admin section and a user section. The admin section can manage the users, manually submit checks for users, accept or deny applicants, edit and create new users.

Users can login and see their donations and edit their own profile like uploading their images and writing a short bio.

## Setup Directions
There are a few things you'll need to setup before getting the site running. The platform uses Stripe, AWS, and Campaign Monitor.

### Stripe

You will need to setup a Stripe account and enable Connect. You'll need to set your Stripe Keys in your .env file:

STRIPE_SECRET=sk_test_
STRIPE_PUBLISHABLE=pk_test_

### Campaign Monitor

Campaign Monitor is a service that sends your emails for you but gives you the ability to design your emails without having to code them. There are several types of emails you'll need to setup.

The follow will need to be created:

* Donation receipts
* Contact form
* Application form
* For the information request at the footer
* Password Resets

Some of these are optional, like the information requests. If you wanted to use Laravel's built in system to send out emails than you can disregard this section and create your own.

The .env file will need these settings:

CAMPAIGN_MONITOR_API_KEY=
CAMPAIGN_MONITOR_CLIENT_ID=

### AWS

AWS will host all your images. This of course is optional.

S3_KEY=
S3_SECRET=
S3_LOCATION=

#### License

The Acacia Platform open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

#### Contributions

I don't have much direction on this but this is available to anyone who's willing to step in and put work into it.

There are a couple of ideas I had. If you wanted to include the stripe fees in the donation that would offset the fees for the missionary giving them more money.

Another idea is to send a monthly email to the missionary with their total donations for the month.

##### Side Note

I have created a supporters section. It's a separate repo. It gives the supporter the ability to log in and see their donations for the year and download a report for their tax filings. If you're interested let me know.

#### Issues

One issue I've seen is that some supporters when donating an exact amount using pennies (like $50.54) it gives and error. Never troubleshooted it but it comes up from time to time.
