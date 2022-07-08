<style>
    input , .bootstrap-select.btn-group button{
        background-color: #f3f4f6  !important;
        height: 44px  !important;
        box-shadow: none  !important;
    }
</style>
<section class="bg-gray-100">
    <div id="wrapper" class="flex flex-col justify-between h-screen">

        <!-- header-->
        <div class="bg-white py-4 shadow dark:bg-gray-800">
            <div class="max-w-6xl mx-auto">


                <div class="flex items-center lg:justify-between justify-around">

                    <a href="trending.html">
                        <img src="assets/images/logo.png" alt="" class="w-32">
                    </a>

                    <div class="capitalize flex font-semibold hidden lg:block my-2 space-x-3 text-center text-sm">
                        <a href="user/login" class="py-3 px-4">Login</a>
                        <a href="user/register" class="bg-purple-500 purple-500 px-6 py-3 rounded-md shadow text-white">Register</a>
                    </div>

                </div>
            </div>
        </div>

        <!-- Content-->
        <div>
            <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">
                <form class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md" data-toggle="validator" method="post">
                    <h1 class="lg:text-2xl text-xl font-semibold mb-6"> Register </h1>

                    <?php
                    /*
                     *                         $data = $_POST;

                                             $firstname = $data['firstname'] ? $data['firstname'] : '';
                                             $lastname = $data['lastname'] ? $data['lastname'] : '';
                                             $email = $data['email'] ? $data['email'] : '';
                                             $login = $data['login'] ? $data['login'] : '';
                     */

                    ?>

                    <div class="grid lg:grid-cols-2 gap-3">
                        <div class="form-group  has-feedback">
                            <label class="mb-0"> First Name </label>
                            <input name="firstname" type="text" placeholder="Your Name" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full"" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group  has-feedback">
                            <label class="mb-0"> Last  Name </label>
                            <input name="lastname" type="text" placeholder="Last  Name" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="form-group  has-feedback">
                        <label class="mb-0"> Login </label>
                        <input name="login" type="text" placeholder="Login" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group  has-feedback">
                        <label class="mb-0"> Email Address </label>
                        <input name="email" type="email" placeholder="Info@example.com" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group  has-feedback">
                        <label class="mb-0"> Password </label>
                        <input name="password" type="password" placeholder="******" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>
                    <div class="form-group  has-feedback">
                        <label class="mb-0">Enter password again </label>
                        <input name="password2" type="password" placeholder="******" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" required>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <div class="checkbox form-group  has-feedback">
                        <input name="checkbox" type="checkbox" id="chekcbox1" checked="" required>
                        <label for="chekcbox1"><span class="checkbox-icon"></span> I agree to the <a href="pages-terms.html" target="_blank" class="uk-text-bold uk-text-small uk-link-reset"> Terms and Conditions </a>
                        </label>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                    </div>

                    <button type="submit" class="bg-blue-600 font-semibold p-2 mt-5 rounded-md text-center text-white w-full">Get Started</button>
                </form>
            </div>
        </div>

        <!-- Footer -->

        <div class="lg:mb-5 py-3 uk-link-reset">
            <div class="flex flex-col items-center justify-between lg:flex-row max-w-6xl mx-auto lg:space-y-0 space-y-3">
                <div class="flex space-x-2 text-gray-700 uppercase">
                    <a href="#"> About</a>
                    <a href="#"> Help</a>
                    <a href="#"> Terms</a>
                    <a href="#"> Privacy</a>
                </div>
                <p class="capitalize"> © copyright 2020 by Socialite</p>
            </div>
        </div>

    </div>
</section>