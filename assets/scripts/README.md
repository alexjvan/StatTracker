# Current Folder Walkthrough
## DB.php
### Description
Simple script to handle connecting to the database, and handling queries.
### Code Walkthrough
function connect() 
{
  create a new pdo, grabbing the connection to the database using the given information in the pdo statement
  set the attributes of the pdo
  return the pdo
}

function jsquery()
{
  copy of the query function, this one used for values given to javascript, the only difference is a given attribute in the fetch.
}

function query()
{
  create a new statement variable, connecting to the database, then prepare the query
  execute the query with the given parameters
  if(the first word in the query is "SELECT")
  {
    grab the data, fetching the data from the statement
    return the data.
  }
}

## Login.php
### Description
Simple script to handle functions with logging in and out the user.
### Code Walkthrough
function isLoggedIn()
{
  if(a cookie is set on the users browser for the website)
  {
    if(a value is found from a new database query SELECTING the user_id FROM login_tokens WHERE the token is the given token, grabbed from the browsers cookie token)
    {
      grab the userid from the previous query
      if(a more temporary cookie is set)
      {
        return the userid;
      }
      else 
      {
        set cstrong to True
        get a new token for a cookie
        from a new database query INSERT the following values into the login_tokens table [null(auto-incr value), the new token, the current user_id]
        from a new database query DELETE  the previous cookie's value from the login_tokens table
        set the cookie to the new cookie value, one for 7 days, and one for 3 days
        return the userid
      }
    }
  }
}

function loginUser(username, password)
{
  if(a value is found from a database query SELECTING the username FROM the users table WHERE the username is equal to the given username)
  {
    if(hashing the current password, is equal to the value gotten from the database)
    {
      set cstrong to True
      get a new token for a cookie
      from a new database query INSERT the following values into the login_tokens table [null(auto-incr value), the new token, the current user_id]
      from a new database query DELETE  the previous cookie's value from the login_tokens table
      set the cookie to the new cookie value, one for 7 days, and one for 3 days
      return the userid
    }
    else
    {
      return "Incorrent Password!";
    }
  }
  else
  {
    return "User not registered";
  }
}

static function logout(allDevices)
{
  if(allDevices)
  {
    from a new database query, delete all the login_tokens where the userid is equal to the current userid
  }
  else
  {
    if(a more permanant cookie is set)
    {
      from a new database query, delete the login token with the given token's value
    }
    set the two cookie's time to its current time, to 0
  }
}
