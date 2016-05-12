<nav class="navbar navbar-inverse navbar-fixed-top app-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-main">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.html">
        <img src="assets/musichub%20copy.png" alt="brand">
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapse-main">

        <ul class="nav navbar-nav hidden-xs">
          <li class="active">
            <a href="loginin3.php">Home</a>
          </li>
          <li>
            <a href="update.php">Profile</a>
          </li>
            <li>
            <a href="post.php">Post</a>
          </li>
            <li>
            <a href="allevents.php">All Events</a>
          </li>
        <button id="more" class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">More
            <span class="caret"></span></button>
            <ul id="menu" class="dropdown-menu">
            <li>
            <a href="eventpost.php">New Events</a>
          </li>
            <li>
            <a href="allcollections.php">All Collections</a>
          </li>
            <li>
            <a href="collectionpost.php">Collections Post</a>
          </li>
            <li>
            <a href="locationlist.php">Location Lists</a>
          </li>
            <li>
            <a href="request.php">Friend Requests</a>
          </li>
          <!--<li>
            <a data-toggle="modal" href="#msgModal">Messages</a>
          </li>-->
          <li>
            <a href="sendrequest.php">Add Friends</a>
          </li>
            </ul>
        </ul>

        <ul class="nav navbar-nav navbar-right m-r-0 hidden-xs">
          <li>
            <button class="btn btn-default navbar-btn navbar-btn-avitar" data-toggle="popover">
              <img class="img-circle" src="assets/avatar1.png">
            </button>
          </li>
        </ul>
        <form action='searchpostsresult.php' method='post' class="navbar-form navbar-right app-search"  role="search">
          <div class="form-group">
            <input name="searchposts" type="text" class="form-control" data-action="grow" placeholder="Search">
          </div>
        </form>

        <ul class="nav navbar-nav hidden">
          <!--<li><a href="#" data-action="growl">Growl</a></li>-->
          <li><a href="index.html">Logout</a></li>
        </ul>
      </div>
  </div>
</nav>