<h1>Create an account</h1>
<form action="" method="post">
    <div class="row mb-3">
        <div class="col">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="emailHelp">
        </div>
        <div class="col">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="emailHelp">
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
        <label for="passwordConfirm" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="passwordConfirm" id="passwordConfirm">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
