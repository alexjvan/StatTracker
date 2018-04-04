# Current Folder Walkthrough
## addstat.php
### Description
This is the file that Unity pushes to. It grabs the information, and stores it into the database.
### Code Walkthrough
include the file that connects with the database.
grab the username from the value posted into the link
grab the value (the stat being added to) posted into the link
grab the adding (the number that the stat is having added to it) posted to the link

if(a value exists from a new database query SELECTING the id FROM the users table WHERE the username is equal to the value, in the array, of the username variable given from the posted link.)
{
  set the userid variable to that same query
  if(a value exists from a new database query SELECTING the value given from the posted link FROM the stats table WHERE the userid is equal to the userid gotten from the previous query)
  {
    set the previousvalue to the previous query
    set the newvalue variable to the previousvalue plus the adding variable
    create a new database query to UPDATE the stats table, SETTING the value to the newvalue WHERE the userid is equal to the userid given in the array of values
    print "Done" onto the page
  }
  else 
  {
    print "Value "+value variable+" not found" onto the page
  }
}
else
{
  print "Player not found" onto the page
}

## createaccount.php
### Description
A page to grab the data posted from the form on the page, and attempts to create an account for the user with the given user.
### Code Walkthrough
a blank error variable
if(the user wanted to logout)
{
  logout the user;
}
else if(the user wanted to login)
{
  send hte user to the login page
}
else if(the user wanted to create an account)
{
  a new username variable with the value given from the post
  a new password variable with the value given from the post
  a new email variable with the value given from the post
  if(none of the values are blank)
  {
    if(not(a value exists from a new database query SELECTING the usernames FROM the users table WHERE the username is equal to the given username variable))
    {
      if(the length of the username is between 3 and 32)
      {
        if(the username only contains the values [a-z], [A-Z], [0-9], and '_')
        {
          if(the email is of valid syntax)
          {
            if(not(a value is found from the query SELECTING the emails FROM the users table WHERE the email is equal to the given email address))
            {
              a new date variable, creating a new date for the creation date of the account
              a new database query, INSERTING the following values into the users table, [null(id that auto-increments), the given username, the given password hashed into an automated 64bit password hash, the given email, and the creation date that was just created
              login the user
              send the user to the users homepage
            }
            else
            {
              set the error to "Email in use!"
            }
          }
          else 
          {
            set the error to "Invalid password!"
          }
        }
        else 
        {
          set the error to "Invalid username!"
        }
      }
      else
      {
        set the error to "User already exists!"
      }
    }
    else
    {
      set the error to "Not all fields were filled out"
    }
  }
}
## index.php
### Description
The home page for the user, or a given user from the link.
## login.php
### Description
A page to grab the data given from a form, and attempts to login the user with the given information.
## logout.php
### Description
A simple script to logout the player.
### Code Walkthrough
include the login script
if(the user is logged in (has a login token))
{
  logout the user
}
move the player to the home page
