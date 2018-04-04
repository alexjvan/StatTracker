# Current Folder Walkthrough
## index.php
### Description
This is the main home page.
## livesearch.php
### Description
This is a simple script that is used by the index page. It grabs all the usernames from the database and finds the ones that are similar to the given query.
### Code Walkthrough
include the script that grabs the database.
set 'q' to the query that is given to the page by the index.
if(the length of the query is greater than 0) 
{
  set the hint to a new string
  set users to a new MySQL Query, SELECTING the username column FROM the users table WHERE the username contains q, in any spot within the text. An empty array is given for the values of the query, which none are needed.
  foreach(user in the users variable)
  {
    add to the hint, a new link of their user page
  }
}

if(the hint variable is empty)
{
 set the response variable to the text "no suggestion";
}
else
{
  set the response variable to the text of the hint
}

print out the response variable onto the page.
