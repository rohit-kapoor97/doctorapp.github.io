<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Doctor App</title>
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" />
</head>
<body class="bg-secondary">
  
     
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-white text-center mb-3">Sign Up!</h2>
             
          <form action="{{ route('register') }}" method="post">
             @csrf

            <div class="form-group">
              <label class="visually-hidden" for="inputName">Name</label>
              <input class="form-control form-Doctor App-control" name="name" type="text" placeholder="Name" />
            </div>
            <div class="form-groupm mt-3">
              <label class="visually-hidden" for="inputPhone">Phone</label>
              <input class="form-control form-Doctor App-control" name="phone" type="text" placeholder="Phone" />
            </div>
            {{-- <div class="col-md-6">
              <label class="form-label visually-hidden" for="inputCategory">Category</label>
              <select class="form-select" id="inputCategory">
                <option selected="selected">Category</option>
                <option> Category One</option>
                <option> Category Two</option>
                <option> Category Three</option>
              </select>
            </div> --}}
            <div class="form-group mt-3">
              <label class="form-label visually-hidden" for="inputEmail">Email</label>
              <input class="form-control form-Doctor App-control" name="email" type="email" placeholder="Email" />
            </div>
            <div class="form-group mt-3">
              <label class="form-label visually-hidden" for="validationTextarea">Password</label>
                 <input class="form-control form-Doctor App-control" name="password" type="password" placeholder="Password" />
             
            </div>
            <div class="col-6 offset-md-3">
              <div class="d-grid">
                <button class="btn btn-primary rounded-pill mt-5" type="submit">Sign in</button>
              </div>
            </div>
          </form>
        </div>
    </div>
    </div>

</body>
</html>