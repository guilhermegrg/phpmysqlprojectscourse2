<?php $pageTitle = "Manage Task!"; ?>


<?php include_once "partials/header.php" ?>

<?php include_once "read.php" ?>


<div class="container-fluid">
    <section class="col .col-xs-12 .col-sm-6 .col-md-8 col-lg-12 main">
        <h3 class="text-primary">Manage Task </h3><hr>

        <table class="table table-striped table-bordered table-responsive">
            <thead>
            <tr><th>Name</th><th>Description</th><th>Status</th><th>Created</th><th>Action</th></tr>
            </thead>
            
            <tbody id="task-list">
            
            <?php foreach ($tasks as $task): ?>
            
            <tr>
                <td title='Click to edit!'>
                <div class='editable'  onclick='makeElementEditable(this)' onblur='updateTaskName(this,<?= $task['id']?>)' ><?= $task['name']?></div>
                </td>
                
                <td  title='Click to edit!'>
                <div  class='editable'  onclick='makeElementEditable(this)' onblur='updateTaskDescription(this,<?= $task['id']?>)' ><?= $task['description']?>
                </div>
                </td>
                
                <td  title='Click to edit!'>
                <div  class='editable' onclick='makeElementEditable(this)' onblur='updateTaskStatus(this,<?= $task['id']?>)'><?= $task['status']?>
                </div>
                </td>
                
                <td><?= $task['created_at']?></td>
                
                <td style='width: 5%;'><button class='btn-danger' onclick='deleteTask(<?= $task['id']?>)' ><i class='fa fa-times'></i></button>
                </td>
            </tr>
            
            <?php endforeach; ?>
            
            </tbody>
        </table>
        <?php echo $paginate->page_links(); ?>
        
    </section>
</div>


<?php include_once "partials/footer.php" ?>