<div class="mcontainer">

                <div class="mb-6">
                    <h2 class="text-2xl font-semibold"> Setting </h2>
                    <nav class="responsive-nav border-b md:m-0 -mx-4">
                        <ul uk-switcher="connect: #form-type; animation: uk-animation-fade">
                            <li class=""><a href="#" class="lg:px-2" aria-expanded="false"> Profile</a></li>
                            <li class=""><a href="#" class="lg:px-2" aria-expanded="false"> Privacy</a></li>
                            <li class=""><a href="#" class="lg:px-2" aria-expanded="false"> Notification</a></li>
                            <li><a href="#" class="lg:px-2" aria-expanded="false"> Social links </a></li>
                            <li class=""><a href="#" class="lg:px-2" aria-expanded="false"> Billing </a></li>
                            <li class="uk-active"><a href="#" class="lg:px-2" aria-expanded="true"> Security </a></li>
                        </ul>
                    </nav>
                </div>


                <div class="grid lg:grid-cols-3 mt-12 gap-8">

                    <div class="bg-white rounded-md lg:shadow-md shadow col-span-2">
                        <form action="user/settings" method="post" enctype="multipart/form-data">
                            <div class="grid grid-cols-2 gap-3 lg:p-6 p-4">
                               <div class="form-group">
                                   <?=\app\helpers\User::getImgCode(null, "img-thumbnail", 200, 200);?>
                                   <input type="file" name="image" placeholder="Select file">
                               </div>
                                <div class="form-group">
                                    <input type="hidden" name="image" value="<?=$_SESSION['user']['img'];?>" >
                                </div>
                               <div class="form-group">
                                   <label for="firstname"> First name</label>
                                   <input name="firstname" type="text" placeholder="" class="shadow-none with-border" value="<?=$_SESSION['user']['firstname'];?>">
                               </div>
                               <div class="form-group">
                                   <label for="lastname"> Last name</label>
                                   <input name="lastname"  type="text" placeholder="" class="shadow-none with-border" value="<?=$_SESSION['user']['lastname'];?>">
                                </div>
                                <div class="col-span-2 form-group">
                                    <label for="email"> Email</label>
                                    <input name="email" type="text" placeholder="" class="shadow-none with-border" value="<?=$_SESSION['user']['email'];?>">
                                </div>
                                <div class="col-span-2 form-group">
                                    <label for="description">About me</label>
                                    <textarea id="about" name="description" rows="3" class="shadow-none bg-gray-100 with-border" spellcheck="false" style="margin-top: 0px; margin-bottom: 0px; height: 136px;"><?=$_SESSION['user']['description'];?></textarea>
                                </div>
                                <div class="col-span-2 form-group">
                                    <label for="location"> Location</label>
                                    <input name="location" type="text" placeholder="" class="shadow-none with-border">
                                </div>
                                <div class="form-group">
                                   <label for="workplace"> Working at</label>
                                   <input name="workplace" type="text" placeholder="" class="shadow-none with-border">
                                </div>
                                <div class="form-group">
                                   <label for="relationship"> Relationship </label>
                                  <select  name="relationship">
                                    <option value="None">None</option>
                                    <option value="Single">Single</option>
                                    <option value="In a relationship">In a relationship</option>
                                    <option value="Married">Married</option>
                                    <option value="Engaged">Engaged</option>
                                  </select></div>
                                </div>
                           </div>
                            <div class="bg-gray-10 p-6 pt-0 flex justify-end space-x-3">
                              <button class=" button bg-red-700" style="background: red;">Clean</button>
                              <button type="submit" class="button bg-blue-700"> Save </button>
                            </div>
                        </form>
                    </div>

                    <div class="bg-white rounded-md lg:shadow-md shadow lg:p-6 p-4 col-span-2">

                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <div>
                                <h4> Who can follow me ?</h4>
                                <div> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, </div>
                            </div>
                            <div class="switches-list -mt-8 is-large">
                                <div class="switch-container">
                                    <label class="switch" data-name="who_can_follow_me"><input type="checkbox" checked=""><span class="switch-button"></span> </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="flex justify-between items-center">
                            <div>
                                <h4> Show my activities  </h4>
                                <div> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, </div>
                            </div>
                            <div class="switches-list -mt-8 is-large">
                                <div class="switch-container">
                                    <label class="switch" data-name="show_my_activities"><input type="checkbox"><span class="switch-button"></span> </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="flex justify-between items-center">
                            <div>
                                <h4> Search engines </h4>
                                <div> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, </div>
                            </div>
                            <div class="switches-list -mt-8 is-large">
                                <div class="switch-container">
                                    <label class="switch" data-name="search_engines"><input type="checkbox" checked=""><span class="switch-button"></span> </label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="flex justify-between items-center">
                            <div>
                                <h4> Allow Commenting </h4>
                                <div> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, </div>
                            </div>
                            <div class="switches-list -mt-8 is-large">
                                <div class="switch-container">
                                    <label class="switch" data-name="allow_commenting"><input type="checkbox"><span class="switch-button"></span> </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>

                </div>


            </div>