         <div class="col-sm-4"  style="min-height:40px; background:yellow;">
           
            <div class="card mt-4">
                <div class="card-body">
                    <img src="images/startblog.png" alt="" class="img-fluid d-block mb-3">
                </div>
                <div clas="text-center">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius voluptates minima cupiditate, id, et dolore ad ducimus nulla eligendi, temporibus eos qui nam aliquam voluptatum labore in sit? Unde, dicta?
                </div>
            </div> 
                 
                 <div class="card mt-4">
                     <div class="card-header bg-dark text-light">
                         <h2 class="lead">Sign Up!</h2>
                     </div>
                     <div class="card-body">
                         <button type="button" class="btn btn-success btn-block text-center text-white">Join the forum</button>
                         <button type="button" class="btn btn-danger btn-block text-center text-white">Login</button>
                         <div class="input-group  mt-2">
                         <input type="text" class="form-control" placeholder="Enter your email">
                         <div class="input-group-append">
                             <button type="button" class="btn btn-primary btn-sm text-center text-white">Subscribe Now!</button>
                         </div>
                     </div>
                     </div>
                     
                     
                 </div>
                  
               <div class="card mt-4">
                   <div class="card-header bg-primary text-light">
                       <h2 class="lead">Categories</h2>
                    </div>
                      
                       <div class="card-body">
                           <?php
                           
                           $cats = getCategories();
                           
                           foreach($cats as $key=>$value){
                $cat = $value;
                
//                var_dump($cat);
                
                $id = $cat['id'];
                $name = $cat['name'];
                           
                               echo "<a href='blog.php?category=$id' class='d-block'>$name</a>";
                            } ?>
                       </div>
                   
               </div>
               
               
               <div class="card mt-4">
                   <div class="card-header bg-primary text-light">
                       <h2 class="lead">Recent Posts</h2>
                    </div>
                      
                       <div class="card-body">
                           <?php
                           
                           $posts = getTopFivePosts();
                           
                           foreach($posts as $key=>$post){
                
                                $id = $post['id'];
                                $name = $post['title'];
                               $image = $post['image'];
                               $time = $post['time'];
                            echo "<div class='media mb-2' >";
                               
                               echo "<img src='uploads/$image' class='img-fluid d-block align-self-start' width='150px'>";
                               echo "<div class='media-body ml-2'>";
                               echo "<a href='FullPost.php?id=$id' class='d-block'>";
                               echo "<h6 class='lead'>$name</h6>";
                               echo "</a>";
                               echo "<p class='small'>$time</p>";
                               
                               echo "</div>";
                               echo "</div>";
                               echo "<hr>";
                            } ?>
                       </div>
                   
               </div>
               
               
           </div>