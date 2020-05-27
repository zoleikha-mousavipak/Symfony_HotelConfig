# Test task for senior backend developer 
This project provides an API for hotels to get their reviews and average score.
Also, for chain hotels it should be possible to get a list of their hotels. A chain hotel is a collection of hotels that belong to one group.

# Todo
- We need to improve the code quality by adopting the SOLID principles and/or other best practices.
- Currently, chain hotels are not defined. We need to implement that.
- Registered Hotels should be able to embed an html/javascript widget on their website.
  The widget should show an average score of all their review scores.
  The widget could consume the average API, that we are providing. The Hotel can potentially have thousands of reviews, so keep that in mind for performance considerations.
- Currently, the average API is using hotelId, but Hotel entity should be identified by a UUID and have a relation to its Reviews.
- The visual design of the widget is not important. It can be just a centered bold white number on a blue background. The size should be 100x100px and it should be positioned fixed in the bottom right corner of the screen.

- The hotelier should be able to embed their widget by simply pasting a snippet like this before the closing </body> tag of their website:

  `<script src="http://host-of-the-app/widget/{{UUID}}.js"></script>`

  Where {{UUID}} is the uuid of the Hotel. To keep this task simple we are not generating other hashes or access keys for using this widget but simply stick to the UUID.
  
  The script which is served as the response should inject an iframe into the DOM of the hotel's website with size & position described above. It contains the widget's html with the styles. For best compatibility with other scripts on the website & minimal size it should use Vanilla JS (plain JS) to inject the iframe and not rely on jQuery or any other frameworks. 
- The response should be cached for clients for 1 hour.

# Deadline
Please complete the task in three days.

# Setup
- composer install
- create schema
- load fixtures
- use the `symfony serve` or the builtin php server for development
