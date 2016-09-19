# pollsWelcome!

First off, welcome to my Polls website. My name is Daniel Lynch and this is my Assignment 2 project for SENG365.

This site was built using AngularJS (front-end), CodeIgnitor(back-end), and Bootstrap (styling).

Date completed: 26/05/2016


Details

Visitors are presented with a list of polls, pulled from the 'polls' table of the database through the back-end services.
They can then choose to vote on a poll, creating a new entry in the votes table of the database, containing the Poll ID, Vote ID and IP address of the user.

Answers for each poll are stored in the database as a string, with each answer seperated by commas.
The controller for the front-end manipulates this as needed. This representation allows new polls to be created easily, and doesn't limit the number of possible answers.

I dedicated a decent portion of time towards the admin page, ensuring that the info is displayed in a clean and easy to use way.

To make the most of the screen space, the section is split into two, with the poll titles on the left that can be expanded/compressed to show/hide the ID, Title, Question, Answers and buttons for viewing and deleting votes. The vote info is then displayed on the right, and showing another poll's votes dynamically changes the view to display the new poll's votes.

In addition, I also created an option to add a new poll to the database through the admin panel, by creating a new service in CodeIgnitor.
I found this was trickier than expected, especially when dealing with spaces and question marks in the fields.
I resolved this by encoding the fields in the Angular controller before generating the URL, and then decoding in the CodeIgnitor model before sending to the database.

When creating a new poll, please seperate answers with a comma.

One particular hurdle I encountered was with special characters in the fields when creating a new poll.
This is because the built-in encoding/decoding functions misses the following: - _ . ! ~ * ' ( )
I fixed this by doing my own encoding (in AngularJS controller) and decoding (in CodeIgnitor model) on the fields before using the built-in functions to do the rest.


Services

The front-end gets the data from the services provided by CodeIgnitor (back-end) in the form of the following:

polls/index.php/services/polls - Gets all polls
polls/index.php/services/polls/id - Gets a specific poll with a given ID
polls/index.php/services/votes/PollId - Gets votes for a specific poll
polls/index.php/services/votes/PollId/vote - POST's a vote to the database, given PollId and VoteId
polls/index.php/services/deletevotes/PollId - Deletes all votes for a specific poll
polls/index.php/services/createpoll/Title/Question/Answers - Generates a new poll


Design

When designing the site, I took advantage of the Bootstrap framework, which ensures that the site looks good on any size screen.
The framework uses a responsive deesign, meaning the content will resize based on the size of the user's screen.

For example, go to the admin page and view some votes for a poll, then reduce the width by resizing your window; you'll notice that the content on the right hand side will gets pushed under the left-side's content (as the width of the screen would make the content too small, without using horizontal scrolling).

I also used Bootstrap's Buttons, Tabs and Panels, along with some Glyphicons (for buttons on admin page).

I'd like to give credit to W3Schools.com's Bootstrap tutorial and code examples which helped me design the site.

