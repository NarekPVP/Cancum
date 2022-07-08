<?php if(isset($_SESSION['user'])): ?>
<div class="container">
    <?php if(!empty($data['groups'])) echo "<h2>Groups</h2>"; ?>
    <?php foreach($data['groups'] as $group): ?>
        <div id="fb" style="margin-top: 10px;">
        <?php if(isset($group->img)): ?>
           <?php if(file_exists("img\groups\\" . $group->img)): ?>
                <img src="<?="img\groups\\" . $group->img;?>" height="100" width="100" alt="Image of user" style="height: 100px; width: 100px;">
            <?php else: ?>
                <img src="<?=$default_group_img_path;?>" alt="" style="height: 100px; width: 100px;">
            <?php endif; ?>
             <?php else: ?>
                 <img src="<?=$default_group_img_path;?>" alt="" style="height: 100px; width: 100px;">
             <?php endif; ?>
            <?php $followers_count = \R::count("groupsfollowers", "group_id = ?", [$group->id]); ?>
            <p id="info"><b><?=$group->title;?></b> <br>
                <?php if($followers_count != 0): ?>
                    <span>Followers: <a href="group/followers?id=<?=$group->id;?>"><?=$followers_count;?></a></span>
                <?php endif; ?>
            </p>
      <div id="button-block">
          <a href="group/page?id=<?=$group->id;?>&rv=<?=$query;?>"><div id="confirm" >Go to group</div></a>
          <a href="group/follow?id=<?=$group->id;?>&user-id=<?=$_SESSION['user']['id'];?>"><div id="confirm" >Follow</div></a>
          <?php $query = \R::findOne("groupsfollowers", "group_id = ? AND follower_id = ?", [$group->id, $_SESSION['user']['id']]); ?>
          <?php if(!$group->creator_id == $_SESSION['user']['id']): ?>
              <?php if(empty($query)): ?>
                <a href="group/follow?id=<?=$group->id;?>"><div id="confirm" >Follow group</div></a>
              <?php else: ?>
                  <a href="group/unfollow?id=<?=$group->id;?>"><div class="btn btn-light" style="background: #DEDEDB;" >Unfollow group</div></a>
              <?php endif;?>
          <?php endif;?>
      </div>
    </div>
    <?php endforeach; ?>
    <?php if(!empty($data['users'])) echo "<h2>Users</h2>"; ?>
    <?php foreach ($data['users'] as $user): ?>
        <?php if($user): ?>
            <div id="fb" style="margin-top: 10px;">

             <?php if(isset($user->img)): ?>
                   <?php if(file_exists("img\users\\" . $user->img)): ?>
                        <img src="<?="img\users\\" . $user->img;?>" height="100" width="100" alt="Image of user" style="height: 100px; width: 100px;">
                   <?php else: ?>
                        <img src="<?=$default_user_img_path;?>" alt="" style="height: 100px; width: 100px;">
                   <?php endif; ?>
             <?php else: ?>
                 <img src="<?=$default_user_img_path;?>" alt="" style="height: 100px; width: 100px;">
             <?php endif; ?>

              <p id="info"><b><?=$user->name;?></b> <br> <span>14 mutual friends</span></p>
              <div id="button-block">

                  <a href="user/profile?id=<?=$user->id;?>&rv=<?=$query;?>"><div id="confirm" >View Profile</div></a>
                  <?php $request = \R::find('requests', "sender = ? AND receiver = ?", [$_SESSION['user']['id'], $user->id]); ?>
                  <?php if(!$request && $user->id != $_SESSION['user']['id']): ?>
                      <a href="friends/send-request?id=<?=$user->id;?>"><div id="confirm" >Add friend</div></a>
                  <?php endif; ?>
              </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php else: ?>
<h1>Please register!</h1>
<?php endif; ?>