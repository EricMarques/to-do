<!-- based on: https://materializecss.com/ -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>To-do list</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
</head>
<body>
  <div class="container">
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <p>Logged as <b>{{ Auth::user()->name }}</b> <button type="submit" class="waves-effect waves-light btn right">Logout</button></p>
    </form>
    <br>
    @isAdmin
    <ul class="collapsible">
      <li>
        <div class="collapsible-header">
          <i class="material-icons">person_add</i>
          Invitations
          <span class="new badge red">4</span>
        </div>
        <div class="collapsible-body">
          <div class="row">
            <div class="col s8">
              <span class="red-text"> <b>Buzz McCallister</b></span>
            </div>
            <div class="col s4">
              <a href="#"><i class="material-icons green-text">check</i></a> | <a href="#!"><i class="material-icons red-text">close</i></a>
            </div>
            <div class="col s8">
              <span class="red-text"> <b>Fuller McCallister</b></span> 
            </div>
            <div class="col s4">
              <a href="#"><i class="material-icons green-text">check</i></a> | <a href="#!"><i class="material-icons red-text">close</i></a>
            </div>
            <div class="col s8">
              <span class="red-text"> <b>Harry Lime</b></span>
            </div>
            <div class="col s4">
              <a href="#"><i class="material-icons green-text">check</i></a> | <a href="#!"><i class="material-icons red-text">close</i></a>
            </div>
            <div class="col s8">
              <span class="red-text"> <b>Marv Merchants</b></span>
            </div>
            <div class="col s4">
              <a href="#"><i class="material-icons green-text">check</i></a> | <a href="#!"><i class="material-icons red-text">close</i></a>
            </div>

          </div>
        </div>
      </li>
    </ul>
    @endisAdmin

    <h1 class="center-align green-text text-darken-4">To-do list</h1>

    @yield('content')
    <br><br>
    <!--  Scripts-->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <script>
      var elem = document.querySelector('.collapsible');
      var options;
      var instance = M.Collapsible.init(elem, options);

      var elem2 = document.querySelector('select');
      var instance = M.FormSelect.init(elem2);
    </script>
  </body>
  </html>
