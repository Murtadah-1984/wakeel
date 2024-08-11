<div id="dw-s1" class="bmd-layout-drawer bg-faded">
	<div class="container-fluid side-bar-container" style="display: flex; flex-direction: column; height: 100vh; ">
		<header class="pb-0">
			<a class="navbar-brand">
				<object class="side-logo" data="<?php echo e(asset('assets/dashboard/svg/logo-8.svg')); ?>" type="image/svg+xml">
				</object>
				</a>
			</header>
				
            <!-- Language Selector -->
	        <p class="side-comment"><?php echo e(__('Languages')); ?></p>
			<li class="side a-collapse short ">
                <a href="<?php echo e(route('lang.switch',(app()->getLocale()=='en'? 'ar': 'en' ))); ?>" class="side-item ">
                    <i class="fas fa-language  mr-1">
                    </i><?php echo e((app()->getLocale()=='en'? __('Arabic') : __('English') )); ?>

                    <span class="badge badge-pill badge-success animate__animated animate__flash animate__repeat-3 animate__slower animate__delay-2s"><?php echo e(app()->getLocale()); ?></span>
                </a>
            </li>
            
            <!-- Social Media -->
			<p class="side-comment"><?php echo e(__('Applications')); ?></p>
			<ul class="side a-collapse short">
                <a class="ul-text">
                    <i class="fa-solid fa-hashtag"></i> <?php echo e(__('Social Media')); ?>

                    <i class="fas fa-chevron-down arrow"></i>
                    <?php if(!request()->is('dashboard')): ?>
                        <span class="badge badge-danger">*</span>
                    <?php endif; ?>
                </a>
                
                    <div class="side-item-container hide animated">
					    <!-- Tiktok -->
						<li class="side-item <?php echo e(request()->is('tiktok') ? 'selected' : ''); ?>">
						    <a href="<?php echo e(route('tiktok')); ?>">
						        <i class="fa-brands fa-tiktok mr-2"></i>
						            <?php echo e(__('Tiktok')); ?>

						    
						    <?php if(!request()->is('tiktok')): ?>
						        <span class="badge badge-danger">9</span>
						    <?php endif; ?>
						    </a>
						</li>
						
						<!-- Instagram -->
						<li class="side-item <?php echo e(request()->is('instagram') ? 'selected' : ''); ?>">
						    <a href="<?php echo e(route('instagram')); ?>">
						        <i class="fa-brands fa-instagram mr-2"></i>
						            <?php echo e(__('Instagram')); ?>

							
							<?php if(!request()->is('instagram')): ?>
						        <span class="badge badge-danger">9</span>
						    <?php endif; ?>
						    </a>
						</li>
						
						<!-- Facebook -->
						<li class="side-item <?php echo e(request()->is('facebook') ? 'selected' : ''); ?>">
						    <a href="<?php echo e(route('facebook')); ?>">
						        <i class="fa-brands fa-facebook mr-2"></i>
						            <?php echo e(__('Facebook')); ?>

						    
						    <?php if(!request()->is('facebook')): ?>
						        <span class="badge badge-danger">9</span>
						    <?php endif; ?>
						    </a>
						</li>
						
						<!-- Youtube -->
						<li class="side-item <?php echo e(request()->is('youtube') ? 'selected' : ''); ?>">
						    <a href="<?php echo e(route('youtube')); ?>">
						        <i class="fa-brands fa-youtube mr-2"></i>
						            <?php echo e(__('YouTube')); ?>

							
							<?php if(!request()->is('youtube')): ?>
						        <span class="badge badge-danger">9</span>
						    <?php endif; ?>
						    </a>
						</li>
						
						<!-- Linkedin -->
						<li class="side-item <?php echo e(request()->is('linkedin') ? 'selected' : ''); ?>">
						<a href="<?php echo e(route('linkedin')); ?>">
						    <i class="fa-brands fa-linkedin mr-2"></i>
						            <?php echo e(__('LinkedIn')); ?>

							
						    <?php if(!request()->is('linkedin')): ?>
						       <span class="badge badge-danger">9</span>
						    <?php endif; ?>
						</a>
					</li>
				</div>
		    </ul>
				
			<!-- Messaging Platforms -->
			<ul class="side a-collapse short">
				<a class="ul-text ">
				    <i class="fa-solid fa-message"></i> 
					        <?php echo e(__('Messaging Platforms')); ?>

					<i class="fas fas fa-chevron-down arrow"></i>
				</a>
					
					
				<div class="side-item-container hide animated">
					    
				    <!-- Whatsapp -->
					<li class="side-item <?php echo e(request()->is('whatsapp') ? 'selected' : ''); ?>">
				        <a href="<?php echo e(route('whatsapp')); ?>">
						    <i class="fa-brands fa-whatsapp mr-2"></i>
						            <?php echo e(__('Whatsapp')); ?>

						    
						    <?php if(!request()->is('whatsapp')): ?>
						        <span class="badge badge-danger">9</span>
						    <?php endif; ?>
						 </a>
					</li>
					
					<!-- Telegram -->
				    <li class="side-item <?php echo e(request()->is('telegram') ? 'selected' : ''); ?>">
				        <a href="<?php echo e(route('telegram')); ?>">
						        <i class="fa-brands fa-telegram mr-2"></i>
						            <?php echo e(__('Telegram')); ?>

						    
						    <?php if(!request()->is('telegram')): ?>
						        <span class="badge badge-danger">9</span>
						    <?php endif; ?>
				        </a>
					</li>
						
					<!-- SMS -->
					<li class="side-item <?php echo e(request()->is('sms') ? 'selected' : ''); ?>">
						<a href="<?php echo e(route('sms')); ?>">
						        <i class="fa-solid fa-message mr-2"></i>
						            <?php echo e(__('SMS')); ?>

						    
						    <?php if(!request()->is('sms')): ?>
						        <span class="badge badge-danger">9</span>
						    <?php endif; ?>
					    </a>
					</li>
				</div>
			</ul>

            <!-- Artificial Inteligence -->
			<ul class="side a-collapse short">
				<a class="ul-text ">
				    <i class="fa-solid fa-brain"></i>
					        <?php echo e(__('Artificial Inteligence')); ?>

					<i class="fas fas fa-chevron-down arrow"></i>
				</a>
					
					
				<div class="side-item-container hide animated">
				   <!-- ChatGPT -->
					<li class="side-item <?php echo e(request()->is('chatgpt') ? 'selected' : ''); ?>">
				        <a href="<?php echo e(route('openai.index')); ?>">
						    <i class="fa-solid fa-brain"></i>
						            <?php echo e(__('ChatGPT')); ?>

						 </a>
					</li> 
				</div>
			</ul>
			
			<!-- Knowledge base builder -->
			<ul class="side a-collapse short">
				<a class="ul-text ">
				    <i class="fa-solid fa-book"></i>
					        <?php echo e(__('Help Me to Help You')); ?>

					<i class="fas fas fa-chevron-down arrow"></i>
				</a>
					
					
				<div class="side-item-container hide animated">
				   <!-- Builder -->
					<li class="side-item <?php echo e(request()->is('telegram') ? 'selected' : ''); ?>">
				        <a href="<?php echo e(route('telegram')); ?>">
						    <i class="fa-solid fa-brain"></i>
						            <?php echo e(__('Builder')); ?>

						 </a>
					</li> 
				</div>
			</ul>
            <!-- contact us -->
				
			<div class="mt-auto">
    			<p class="side-comment"><?php echo e(__ ('Contact Us')); ?></p>
    			<div class="d-flex justify-content-around align-items-center">
    			    <!-- Tiktok -->
    				<a href="<?php echo e(route('tiktok')); ?>">
    				    <i class="fa-brands fa-tiktok mr-2"></i>
    				</a>
    				
    				
    			    <!-- Instagram -->
    				<a href="<?php echo e(route('tiktok')); ?>">
    				    <i class="fa-brands fa-instagram mr-2"></i>
    				</a>
    				
    				
    				<!-- Facebook -->
    				<a href="<?php echo e(route('tiktok')); ?>">
    				    <i class="fa-brands fa-facebook mr-2"></i>
    				</a>
    				    
    				<!-- Email -->
    				<a href="mailto:info@arajeez.com">
    				    <i class="fa-regular fa-envelope mr-2"></i>
    				</a>
    
    				
    				<!-- whatsapp -->
    				<a href="<?php echo e(route('tiktok')); ?>">
    				    <i class="fa-brands fa-whatsapp mr-2"></i>
    				</a>
    			</div>
                

                <!-- User Info -->
                
                <p class="side-comment"><?php echo e(__('User Info')); ?></p>
                <h6 class="text-center"><?php echo e(Auth::user()->name); ?></h6>
                <p class="text-center text-muted mb-1"><?php echo e(__('Subscription:')); ?> <?php echo e(Auth::user()->subscription->name ?? 'None'); ?></p>
                <p class="text-center text-muted"><?php echo e(__('Expires:')); ?> <?php echo e(Auth::user()->subscription->expires_at ?? 'N/A'); ?></p>
            </div>
	</div>
</div><?php /**PATH /home/arajeeznet/wakeel.arajeez.net/wakeel/resources/views/partials/dashboard/sidebar.blade.php ENDPATH**/ ?>