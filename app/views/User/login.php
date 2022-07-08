<style>
    input , .bootstrap-select.btn-group button{
        background-color: #f3f4f6  !important;
        height: 44px  !important;
        box-shadow: none  !important;
    }
</style>
<section class="bg-gray-100">
<div id="wrapper" class="flex flex-col justify-between h-screen">
            <!-- Content-->
    <div>
        <div class="lg:p-10 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">
            <form class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md" method="post" action="user/login">
                <h1 class="lg:text-2xl text-xl font-semibold mb-6"> Login </h1>

                <div>
                    <label class="mb-0"> Login </label>
                    <input name="login" type="text" placeholder="login" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" required>
                </div>
                <div>
                    <label class="mb-0"> Email Address </label>
                    <input name="email" type="email" placeholder="Info@example.com" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" required>
                </div>
                <div>
                    <label class="mb-0"> Password </label>
                    <input name="password" type="password" placeholder="******" class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full" required>
                </div>

                <div>
                    <button type="submit" class="bg-blue-600 font-semibold p-2 mt-5 rounded-md text-center text-white w-full">Get Started</button>

                    <a href="user/register" class="bg-blue-600 font-semibold p-2 mt-5 rounded-md text-center text-white w-full">Register</a>
                </div>
            </form>

        </div>
    </div>


</div>
</section>