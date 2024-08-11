<div id="dw-s1" class="bmd-layout-drawer bg-faded">
	<div class="container-fluid side-bar-container" style="display: flex; flex-direction: column; height: 100vh; ">
		<header class="pb-0">
			<a class="navbar-brand">
				<object class="side-logo" data="{{ asset('assets/dashboard/svg/logo-8.svg') }}" type="image/svg+xml">
				</object>
				</a>
			</header>
				
            <!-- Language Selector -->
	        <p class="side-comment">{{ __('Languages') }}</p>
			<li class="side a-collapse short ">
                <a href="{{ route('lang.switch',(app()->getLocale()=='en'? 'ar': 'en' )) }}" class="side-item ">
                    <i class="fas fa-language  mr-1">
                    </i>{{ (app()->getLocale()=='en'? __('Arabic') : __('English') ) }}
                    <span class="badge badge-pill badge-success animate__animated animate__flash animate__repeat-3 animate__slower animate__delay-2s">{{ app()->getLocale() }}</span>
                </a>
            </li>
            
            <!-- Social Media -->
			<p class="side-comment">{{ __('Applications') }}</p>
			<ul class="side a-collapse short">
                <a class="ul-text">
                    <i class="fa-solid fa-hashtag"></i> {{ __('Social Media') }}
                    <i class="fas fa-chevron-down arrow"></i>
                    @if (!request()->is('dashboard'))
                        <span class="badge badge-danger">*</span>
                    @endif
                </a>
                
                    <div class="side-item-container hide animated">
					    <!-- Tiktok -->
						<li class="side-item {{ request()->is('tiktok') ? 'selected' : '' }}">
						    <a href="{{ route('tiktok') }}">
						        <i class="fa-brands fa-tiktok mr-2"></i>
						            {{ __('Tiktok') }}
						    
						    @if (!request()->is('tiktok'))
						        <span class="badge badge-danger">9</span>
						    @endif
						    </a>
						</li>
						
						<!-- Instagram -->
						<li class="side-item {{ request()->is('instagram') ? 'selected' : '' }}">
						    <a href="{{ route('instagram') }}">
						        <i class="fa-brands fa-instagram mr-2"></i>
						            {{ __('Instagram') }}
							
							@if (!request()->is('instagram'))
						        <span class="badge badge-danger">9</span>
						    @endif
						    </a>
						</li>
						
						<!-- Facebook -->
						<li class="side-item {{ request()->is('facebook') ? 'selected' : '' }}">
						    <a href="{{ route('facebook') }}">
						        <i class="fa-brands fa-facebook mr-2"></i>
						            {{ __('Facebook') }}
						    
						    @if (!request()->is('facebook'))
						        <span class="badge badge-danger">9</span>
						    @endif
						    </a>
						</li>
						
						<!-- Youtube -->
						<li class="side-item {{ request()->is('youtube') ? 'selected' : '' }}">
						    <a href="{{ route('youtube') }}">
						        <i class="fa-brands fa-youtube mr-2"></i>
						            {{ __('YouTube') }}
							
							@if (!request()->is('youtube'))
						        <span class="badge badge-danger">9</span>
						    @endif
						    </a>
						</li>
						
						<!-- Linkedin -->
						<li class="side-item {{ request()->is('linkedin') ? 'selected' : '' }}">
						<a href="{{ route('linkedin') }}">
						    <i class="fa-brands fa-linkedin mr-2"></i>
						            {{ __('LinkedIn') }}
							
						    @if (!request()->is('linkedin'))
						       <span class="badge badge-danger">9</span>
						    @endif
						</a>
					</li>
				</div>
		    </ul>
				
			<!-- Messaging Platforms -->
			<ul class="side a-collapse short">
				<a class="ul-text ">
				    <i class="fa-solid fa-message"></i> 
					        {{ __('Messaging Platforms') }}
					<i class="fas fas fa-chevron-down arrow"></i>
				</a>
					
					
				<div class="side-item-container hide animated">
					    
				    <!-- Whatsapp -->
					<li class="side-item {{ request()->is('whatsapp') ? 'selected' : '' }}">
				        <a href="{{ route('whatsapp') }}">
						    <i class="fa-brands fa-whatsapp mr-2"></i>
						            {{ __('Whatsapp') }}
						    
						    @if (!request()->is('whatsapp'))
						        <span class="badge badge-danger">9</span>
						    @endif
						 </a>
					</li>
					
					<!-- Telegram -->
				    <li class="side-item {{ request()->is('telegram') ? 'selected' : '' }}">
				        <a href="{{ route('telegram') }}">
						        <i class="fa-brands fa-telegram mr-2"></i>
						            {{ __('Telegram') }}
						    
						    @if (!request()->is('telegram'))
						        <span class="badge badge-danger">9</span>
						    @endif
				        </a>
					</li>
						
					<!-- SMS -->
					<li class="side-item {{ request()->is('sms') ? 'selected' : '' }}">
						<a href="{{ route('sms') }}">
						        <i class="fa-solid fa-message mr-2"></i>
						            {{ __('SMS') }}
						    
						    @if (!request()->is('sms'))
						        <span class="badge badge-danger">9</span>
						    @endif
					    </a>
					</li>
				</div>
			</ul>

            <!-- Artificial Inteligence -->
			<ul class="side a-collapse short">
				<a class="ul-text ">
				    <i class="fa-solid fa-brain"></i>
					        {{ __('Artificial Inteligence') }}
					<i class="fas fas fa-chevron-down arrow"></i>
				</a>
					
					
				<div class="side-item-container hide animated">
				   <!-- ChatGPT -->
					<li class="side-item {{ request()->is('chatgpt') ? 'selected' : '' }}">
				        <a href="{{ route('openai.index') }}">
						    <i class="fa-solid fa-brain"></i>
						            {{ __('ChatGPT') }}
						 </a>
					</li> 
				</div>
			</ul>
			
			<!-- Knowledge base builder -->
			<ul class="side a-collapse short">
				<a class="ul-text ">
				    <i class="fa-solid fa-book"></i>
					        {{ __('Help Me to Help You') }}
					<i class="fas fas fa-chevron-down arrow"></i>
				</a>
					
					
				<div class="side-item-container hide animated">
				   <!-- Builder -->
					<li class="side-item {{ request()->is('telegram') ? 'selected' : '' }}">
				        <a href="{{ route('telegram') }}">
						    <i class="fa-solid fa-brain"></i>
						            {{ __('Builder') }}
						 </a>
					</li> 
				</div>
			</ul>
            <!-- contact us -->
				
			<div class="mt-auto">
    			<p class="side-comment">{{ __ ('Contact Us') }}</p>
    			<div class="d-flex justify-content-around align-items-center">
    			    <!-- Tiktok -->
    				<a href="{{ route('tiktok') }}">
    				    <i class="fa-brands fa-tiktok mr-2"></i>
    				</a>
    				
    				
    			    <!-- Instagram -->
    				<a href="{{ route('tiktok') }}">
    				    <i class="fa-brands fa-instagram mr-2"></i>
    				</a>
    				
    				
    				<!-- Facebook -->
    				<a href="{{ route('tiktok') }}">
    				    <i class="fa-brands fa-facebook mr-2"></i>
    				</a>
    				    
    				<!-- Email -->
    				<a href="mailto:info@arajeez.com">
    				    <i class="fa-regular fa-envelope mr-2"></i>
    				</a>
    
    				
    				<!-- whatsapp -->
    				<a href="{{ route('tiktok') }}">
    				    <i class="fa-brands fa-whatsapp mr-2"></i>
    				</a>
    			</div>
                

                <!-- User Info -->
                
                <p class="side-comment">{{ __('User Info') }}</p>
                <h6 class="text-center">{{ Auth::user()->name }}</h6>
                <p class="text-center text-muted mb-1">{{ __('Subscription:') }} {{ Auth::user()->subscription->name ?? 'None' }}</p>
                <p class="text-center text-muted">{{ __('Expires:') }} {{ Auth::user()->subscription->expires_at ?? 'N/A' }}</p>
            </div>
	</div>
</div>