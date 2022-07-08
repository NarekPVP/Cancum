<!--
 <div>
 <label for="" class="font-semibold text-base"> Group Category </label>
 <select id="" name=""  class="shadow-none selectpicker with-border">
     <option value="1">Technology</option>
     <option value="2">Cars and Vehicles</option>
     <option value="3">Comedy</option>
     <option value="4">Economics and Trade</option>
     <option value="5">Education</option>
     <option value="6">Entertainment</option>
     <option value="7">Movies & Animation</option>
     <option value="8">Gaming</option>
     <option value="9">History and Facts</option>
     <option value="10">Live Style</option>
     <option value="0">Other</option>
</select>
</div>
 -->

<form action="posts/edit?id=<?=$id;?>" method="post" enctype="multipart/form-data">
    <?php $post = \app\helpers\Post::get($id); ?>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="title" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter title" style="width: 750px;" value="<?=$post->title;?>">
  </div>

    <div class="form-group" style="width: 750px;">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" rows="3" placeholder="Enter ..." ><?=$post->content;?></textarea>
    </div>
    <div class="form-group">
        <div class="post">
          <!-- /.user-block -->
          <div class="row mb-3">
            <!-- /.col -->
            <div class="col-sm-8">
              
                
                <!-- display images -->
                <?php if(strpos($post->img, "|")): ?>
                  <!-- multi -->
                  <?php $paths = explode("|", $post->img); ?>
                  <div class="grid md:grid-cols-4 grid-cols-2 gap-3 mt-5">
                  <?php foreach($paths as $path): ?>
                    <?php if(file_exists($path)): ?>
                      <!--href='posts/delete-image'-->
                    
                    <div class='delete-hover delete-image' data-path='<?=$path;?>' data-postid=<?=$id;?>>
                        <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                        <img data-path="<?=$path;?>" src="<?=$path;?>" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small flex items-center">
                                <div class="flex-1">
                                    <div class="text-lg">Delete</div>
                                </div>
                                <div class="flex-1">
                                    <a href="<?=$path;?>" class="text-lg show-image" style="cursor: pointer;" target="_blank">View</a>
                                </div>
                                <!-- download btn -->
                                <!-- <i class="btn-down text-2xl uil-cloud-download px-1"></i> -->
                            </div>
                        </div>
                    </div>
                      
                    <?php endif; ?>
                  <?php endforeach; ?>
                  </div>
                <?php else: ?>
                  <!-- single -->
                  <?php $path = $post->img; ?>
                  <?php if(is_file($path)): ?>
                    <!--href='posts/delete-image'-->
                          <div class="grid md:grid-cols-4 grid-cols-2 gap-3 mt-5">
                            <a class='delete-hover delete-image' data-path='<?=$path;?>' data-postid=<?=$id;?>>
                                <div class="bg-green-400 max-w-full lg:h-56 h-48 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                                <img data-path="<?=$path;?>" src="<?=$path;?>" class="w-full h-full absolute object-cover inset-0">
                                    <!-- overly-->
                                    <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                                    <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small flex items-center">
                                        <div class="flex-1">
                                            <a class="text-lg delete-image" data-path='<?=$path;?>' data-postid=<?=$id;?> style="cursor: pointer;">Delete image</a>
                                        </div>
                                        <div class="flex-1">
                                            <a href="<?=$path;?>" class="text-lg show-image" style="cursor: pointer;" target="_blank">View image</a>
                                        </div>
                                        <!-- download btn -->
                                        <!-- <i class="btn-down text-2xl uil-cloud-download px-1"></i> -->
                                    </div>
                                </div>
                            </a>
                         </div>
                  <?php endif; ?>
                <?php endif ?>
                </div>
          </div>
          <!-- /.row -->
          <?php if(strpos($post->img, "|")): ?>
            <a class="btn btn-danger" href="posts/delete-all-images?id=<?=$id;?>">Delete all images</a>
          <?php endif; ?>
        </div>
    </div>

    <?php if($categories): ?>
    <div class="form-group">
        <label for="category" class="font-semibold text-base"> Post Category </label>
        <select id="category" name="category"  class="shadow-none with-border" style="width: 750px;">
            <?php foreach ($categories as $category): ?>
            <option value="<?=$category->id;?>"><?=$category->category_name;?></option>
            <?php endforeach; ?>
            <option value="0">Other</option>
            <!--  -->
       </select>
    </div>
    <?php endif; ?>

  <div class="form-group">
      <div class="flex flex-1 items-center space-x-2">

          <input id="file-input" type="file" name="images[]" style="display: none;" multiple/>
          <a class="file-dialog"><svg class="bg-blue-100 h-9 p-1.5 rounded-full text-blue-600 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></a>

          <svg class="text-red-600 h-9 p-1.5 rounded-full bg-red-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"> </path></svg>
          <svg class="text-green-600 h-9 p-1.5 rounded-full bg-green-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
          <svg class="text-pink-600 h-9 p-1.5 rounded-full bg-pink-100 w-9 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"> </path></svg>
          <svg class="text-pink-600 h-9 p-1.5 rounded-full bg-pink-100 w-9 cursor-pointer" id="veiw-more" hidden fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"> </path></svg>
          <svg class="text-pink-600 h-9 p-1.5 rounded-full bg-pink-100 w-9 cursor-pointer" id="veiw-more" hidden fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"  d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
          <svg class="text-purple-600 h-9 p-1.5 rounded-full bg-purple-100 w-9 cursor-pointer" id="veiw-more" hidden fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path> </svg>

          <!-- view more -->
          <svg class="hover:bg-gray-200 h-9 p-1.5 rounded-full w-9 cursor-pointer" id="veiw-more" uk-toggle="target: #veiw-more; animation: uk-animation-fade" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"> </path></svg>

      </div>
  </div>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>