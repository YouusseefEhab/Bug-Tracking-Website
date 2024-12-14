# Bug-Tracking-WebApp


### This Bug Tracking Web Application manages Bugs for different Projects.
### Front-End: Html, Css, Javascript (Css and Javascript From Bootstrap Template)
### Back-End: PHP, MySQL

<br>

## App Explanation:

### What the App does, is manage bugs for multiple projects, by having 3 types of users:
<ol>
    <li>Customer</li>
    <li>Administrator</li>
    <li>Staff Member</li>
</ol>

<br>

#### Customer
<ul>
	<li>Log into the App</li>
	<li>Send Bug Details raised from their Software to Administrator (Including Screenshot)</li>
	<li>Monitor Bug's Case-Flow Details</li>
</ul>

#### Administrator
<ul>
	<li>Log into the App</li>
	<li>Add Administrators and Staff Members Accounts to App</li>
	<li>Add Projects to App</li>
	<li>View Bugs sent from Customers</li>
	<li>Assign Bugs to Staff Members</li>
	<li>Monitor Bug's Case-Flow Details</li>
	<li>Send Messages to Customers regarding their Bug</li>
</ul>

#### Staff Member
<ul>
	<li>Log into the App</li>
	<li>View Bugs Assigned to Them</li>
	<li>Monitor Bug's Case-Flow Details</li>
	<li>Assign Bug to other Staff Member if the Bug is related to them</li>
	<li>Send Solution Message to Customer regarding their Bug</li>
</ul>

<br>
<br>

### Database Tables:
<ul>
	<li>Users</li>
	<li>Roles</li>
	<li>Projects</li>
	<li>Categories</li>
	<li>Bugs</li>
	<li>Priorities</li>
	<li>Statuses</li>
	<li>Messages</li>
</ul>

<br>

#### Roles
This table contains The Main Roles for Users
<ul>
	<li>ID (Primary Key)</li>
	<li>Role</li>
</ul>

#### Users
This table contains Authentication data for Users
<ul>
	<li>ID (Primary Key)</li>
	<li>Username</li>
	<li>Email</li>
	<li>Password</li>
	<li>Role ID (Foreign Key -> Roles.ID)</li>
</ul>

#### Categories
This table contains The Projects' different Categories
<ul>
	<li>ID (Primary Key)</li>
	<li>Name</li>
</ul>

#### Projects
This table contains Projects' data
<ul>
	<li>ID (Primary Key)</li>
	<li>Name</li>
	<li>Category ID (Foreign Key -> Categories.ID)</li>
</ul>

#### Priorities
This table contains Bugs' Priorities
<ul>
	<li>ID (Primary Key)</li>
	<li>Priority</li>
</ul>

#### Statuses
This table contains Bugs' Statuses
<ul>
	<li>ID (Primary Key)</li>
	<li>Status</li>
</ul>

#### Bugs
This table contains Bugs' data
<ul>
	<li>ID (Primary Key)</li>
	<li>Priority ID (Foreign Key -> Priorities.ID)</li>
	<li>Status ID (Foreign Key -> Statuses.ID)</li>
	<li>Date Created</li>
	<li>Description</li>
	<li>Project ID (Foreign Key -> Projects.ID)</li>
	<li>Assigned Staff ID (Foreign Key -> Users.ID)</li>
	<li>Reporter ID (Foreign Key -> Users.ID)</li>
</ul>

#### Messages
This table contains Messages sent to Customers
<ul>
	<li>ID (Primary Key)</li>
	<li>Message</li>
	<li>Sender ID (Foreign Key -> Users.ID)</li>
	<li>Receiver ID (Foreign Key -> Users.ID)</li>
	<li>Bug ID (Foreign Key -> Bugs.ID)</li>
</ul>
