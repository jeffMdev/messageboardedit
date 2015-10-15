<div class="row">
        <h1 class="page-header">Message Details</h1>
</div>
<div class="row">
	<div class="col-lg-8">
		<?php //echo $this->Form->create('Message'); ?>
		<?php //echo $this->Form->input('content', array('class' => 'form-control input-sm', 'label' => false, 'placeholder' => 'Message*')); ?>
		<textarea id="message" class="form-control input-sm" placeholder="Message *" style="height:100px;"></textarea>
		 <div class="btn-group">
            <div class="btn">
            	<button id="btn-reply" class="btn btn-success">Reply Message</button>
            </div>
            <?php 
            	$this->Js->submit('sdfReply Message Ajax', array(
            		'before' => $this->Js->get('#inprogress')->effect('fadeIn'),
            		'success' => $this->Js->get('#inprogress')->effect('fadeOut'),
            		'update' => '#success'
            	));

                // echo $this->Form->end();           
            ?>
            <div class="btn">
            <?php
                echo $this->html->link('Cancel', array('controller' => 'messages', 'action' => 'index'), array('class' => 'btn btn-warning'));
             ?>
            </div>
        </div>
	</div>
</div>
<div id="success"></div>
<div class="row">
	<div class="col-lg-8">
		<br>
        <div class="panel panel-default">
            <div class="panel-heading">                
                Messages
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">    
            	<?php if($messages) : ?>        	
				<?php foreach ($messages as $message) : ?>
					<?php if ($message['msg']['from_id'] != $this->Session->read('Auth.User.id')) : ?>
						<div class="alert alert-success alert-dismissable">               
		                    <ul class="list-unstyled">
		                    	<li class="navbar-left"><?php 
		                    		$imgSrc = '/app/webroot/img/pic_00.jpg';
									if (!empty($message['usr']['image'])) {
										$imgSrc = '/app/webroot/img/profile_img/' . $message['usr']['image'];
									}
		                    		echo $this->Html->image(
		                    			$imgSrc, 
			                    		array(
			                    			'id' => 'pic', 
			                    			'name' => 'pic', 
			                    			'width' => '60', 
			                    			'height' => '60', 
			                    			'class' => 'img-thumbnail',
			                    			'style' => 'margin-right:10px;'
			                    		)
			                    	); ?>
		                    	</li>
		                    	<li class="h4"><?php echo $message['usr']['name']; ?></li>
		                    	<li class="h6"><?php echo $message['msg']['content']; ?></li>
		                    	<li class="text-info h6">Date: <?php echo date('F d, Y g:i A', strtotime($message['msg']['created'])); ?></li>
		                    	
		                    </ul>
	                	</div>
                	<?php else : ?>
	                	<div class="alert alert-info alert-dismissable">
		                    <ul class="list-unstyled">
		                    	<li class="navbar-right"><?php 
		                    		$imgSrc = '/app/webroot/img/pic_00.jpg';
									if (!empty($message['usr']['image'])) {
										$imgSrc = '/app/webroot/img/profile_img/' . $message['usr']['image'];
									}
		                    		echo $this->Html->image(
		                    			$imgSrc, 
			                    		array(
			                    			'id' => 'pic', 
			                    			'name' => 'pic', 
			                    			'width' => '60', 
			                    			'height' => '60', 
			                    			'class' => 'img-thumbnail',
			                    		)
			                    	); ?>
		                    	</li>
		                    	<li class="h4"><?php echo $message['usr']['name']; ?></li>
		                    	<li class="h6"><?php echo $message['msg']['content']; ?></li>
		                    	<li class="text-info h6">Date: <?php echo date('F d, Y g:i A', strtotime($message['msg']['created'])); ?></li>
		                    	
		                    </ul>
	                	</div>
					<?php endif; ?>
					
				<?php endforeach; ?>
				<?php else : ?>
					You have no messages!
				<?php endif; ?>
            </div>
            <!-- .panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>

<script>
	$(document).ready(function(){
		$('#btn-reply').click(function(){
			$.post(
				"<?php echo $this->request->webroot; ?>messages/replyajax",
				{
					content: $('#message').val(),
					to_id: "<?php echo $this->request->params['pass']['0']; ?>"
				},
				function(data){
					$('#success').html(
						data.image + "<br>"
						+ data.content + "<br>"
						+ data.created + "<br>"
					);
				},
				"json"
			);
		});
	});
</script>