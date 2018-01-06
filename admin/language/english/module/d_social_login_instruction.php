<?php 
$_['text_instruction']          = 'Instructions';
$_['text_instructions_full']    = '
    <p>Social login lets you implement login buttons of the most popular social networks in the world. With the new version you get more options. When updating, check the instructions manual.</p>
    <h2>Set up buttons</h2>
    <ol>
        <li>You will need to go to settings and set up the buttons App id and secrets for the social logins you want to use.</li>
        <li>Sort them and check the checkbox for those that should be shown</li>
        <li>Once you have edited the settings, use the module tab to place the buttons on the shop like any other module.</li>
    </ol>

    <h2>How to edit language</h2>
    <p>Our module uses the basic language process. There is a language file in catalog/language/english/module/d_social_login.php. You can create your own languag file and update the languages.</p>

    <h2>Why do some social logins require an email?</h2>
    <p>Some social networks do not provide the email from the profile, like twitter and vkontakte. Since opencart requires an account to have at least have an email, when the client uses one of such login buttons, he will be redirected to a page where he will be asked to add an email.</p>

    <h2>What is the last Popup screen?</h2>
    <p>
    Signing in with social networks is cool, yet it provides very little information about the customer. You mainly get the name and the email. And some networks do not even provide the email. For these cases you have an extra step at the end of the registration. It only pops up when the customer logins for the first time. You can customize it to fit your design - change the background image, add the fields you really need (all of them will be required, so think twice before activating them.)
    <img src="view/image/d_social_login/extra_step.png" class="img-thumbnail img-responsive"/>
    </p>
    <h2>Troubleshooting</h2>
    <p> If you have issues with setting up the module, try these steps:
        <ol>
            <li></li>

            <div class="bs-callout bs-callout-warning">
                <h4>Important if Updating from older versions!</h4>
                <p>We have rethought the process of logging. This is why we have changed the callback urls which solved alot of issues. But now you must reset the callback urls for some of the social logins. If you social login is not working - its probably the callback url.<br/><br/>'.HTTPS_CATALOG.'<strong>d_social_login.php?</strong>hauth.done=Google<br/><br/> </p>
            </div>

            <li>Check that your newly created App is activated. i.e. Facebook keeps new apps deactivated and Twitter needs extra checkbox to allow social logins.</li>


            <li>Check that you have access to your callback path - visit <a href="'.HTTPS_CATALOG.'d_social_login.php">'.HTTPS_CATALOG.'d_social_login.php</a>. You should see this text HybridAuth Open Source Social Sign On PHP Library. hybridauth.sourceforge.net/. If you do not see it - try adding permissions 755 or 777 to your folder '.HTTPS_CATALOG.'catalog/model/d_social_login/ </li>
            <li>Give it 1 hour to refresh the cache on the social network side and try again.</li>
            <li>Send us a support ticket at <a href="http://dreamvention.com/support">dreamvention.com/support</a></li>
        </ol>
    </p>
    <h2>My social logins stopped working after update</h2>
    <p>Thats ok. We have changed the process to add more social logins. You apps will start working in no-time. Simply follow the updated instructions on how to set up social logins.</p>';

$_['text_instructions_tabs'] = array(
    'google_plus' =>
        '<h3 class="tab-title"><i class="fa fa-google-plus"></i> Setup Google+ login button</h3>
        <div class="tab-body">
            <ol>
                <li>Visit the Google Developers console <a href="https://cloud.google.com/console" target="_blank"> https://cloud.google.com/console</a></li>
                <li>Create a new project by clicking on the top right corner</li>
                <img src="view/image/d_social_login/google/1-create-project.png" class="img-thumbnail img-responsive" />
                <li>Fill in the project name and click save </li>
                <img src="view/image/d_social_login/google/2-create-project-popup.png" class="img-thumbnail img-responsive" />
                <li>Wait for several seconds for the project to be created. </li>
                <img src="view/image/d_social_login/google/3-create-project-wait.png" class="img-thumbnail img-responsive" />
                <li>Go to APIs and credentials like keys option in the one of the blocks</li>
                <img src="view/image/d_social_login/google/3-edit-api-data.png" class="img-thumbnail img-responsive" />

                <li>Then on the left visit credentials and click button Add Credentials</li>
                <img src="view/image/d_social_login/google/4-create-client-id.png" class="img-thumbnail img-responsive" />

                <li>In the popup select OAuth 2.0 option</li>
                <img src="view/image/d_social_login/google/5-create-client-id-popup.png" class="img-thumbnail img-responsive" />
                <li>You will be asked to input the product name of your app. Click create and go to consent screen and input name and url. Save</li>
                <img src="view/image/d_social_login/google/7-consent-screen.png" class="img-thumbnail img-responsive" />
                <li>Now you are ready to create your web app for signup. Select webapp and input the domain name and redirect url (below)</li>
                <img src="view/image/d_social_login/google/6-create-client-id-calbackurl.png" class="img-thumbnail img-responsive" />
                <li>Please fill in the Redirect URIs with the correct url</li>
                <div class="bs-callout bs-callout-warning">
                    <h4>Your Redirect URL</h4><p>' . HTTP_CATALOG . 'd_social_login.php?hauth.done=Google</p><h4>Your Redirect URL for HTTPS</h4>
                    <p>' . HTTPS_CATALOG . 'd_social_login.php?hauth.done=Google</p>
                </div>
                <li>Google+ requires the apis to be enabled. Click APIs on the left and find <strong>Social APPs Google+ APIs</strong></li>
                <img src="view/image/d_social_login/google/10-apis.png" class="img-thumbnail img-responsive" />
                <li>Click enable.</li>
                <img src="view/image/d_social_login/google/11-apis-enable.png" class="img-thumbnail img-responsive" />
                <li>It may be enabled already. Leave it as is</li>
                <img src="view/image/d_social_login/google/12-apis-enabled.png" class="img-thumbnail img-responsive" />
                <li>Fill in the Client Id and Client Secret in the Social Login settings tab for Google+</li>
                <img src="view/image/d_social_login/google/14-get-apis-keys.png" class="img-thumbnail img-responsive" />
            </ol>
            <div class="bs-callout bs-callout-warning">
                <h4>Attention!</h4>
                <p>If you get an error from google, or a white screen- please check that you compleated all the steps.</p>
            </div>
            <ol>
                <li>Go to App settings in google dev console.</li>
                <li>Go to tab APIs & auth  and then to Consent Screen</li>
                <li>Fill the required fields as shown on the image below</li>
                <img src="view/image/d_social_login/google/13-error.png" class="img-thumbnail img-responsive" />
                <li>Save and wait for several minutes for the Google api to refresh its data then test the login.</li>
            </ol>
        </div>',
    
    'facebook' =>
        '<h3 class="tab-title"><i class="fa fa-facebook"></i> Setup Facebook login button</h3>
        <div class="tab-body">
            <ol>
                <li>Visit facebook developers page <a href="https://developers.facebook.com/" target="_blank">https://developers.facebook.com/</a></li>
                <li>In menu Apps – select create new app</li>
                <img src="view/image/d_social_login/facebook/1-my-app.png" class="img-thumbnail img-responsive" />
                <li>Select WWW option</li>
                <img src="view/image/d_social_login/facebook/2-my-app-www.png" class="img-thumbnail img-responsive" />
                <li>Skip the Setup step by clicking the button on the top right</li>
                <img src="view/image/d_social_login/facebook/3-my-app-skip.png" class="img-thumbnail img-responsive" />
                <li>In the popup window fill in the Display Name and Choose category</li>
                <img src="view/image/d_social_login/facebook/4-my-app-create.png" class="img-thumbnail img-responsive" />
                <li>After the app is created, go to settings in the left menu</li>
                <li>Fill in Namespace and Contact Email</li>
                <img src="view/image/d_social_login/facebook/5-settings.png" class="img-thumbnail img-responsive" />
                <li>Click Add platform and select Website</li>
                <img src="view/image/d_social_login/facebook/6-settings-website.png" class="img-thumbnail img-responsive" />
                <li>Fill in the Site url and mobile site url and save</li>
                <img src="view/image/d_social_login/facebook/7-settings-website-save.png" class="img-thumbnail img-responsive" />
                <div class="bs-callout bs-callout-warning"><h4>Your Site URL</h4>
                  <p>' . HTTP_CATALOG . '</p>
                  <h4>Your Redirect URL for HTTPS still the same http (facebook issue)</h4>
                  <p>' . HTTP_CATALOG . '</p>
                </div>
                <img src="view/image/d_social_login/facebook/8-dashboard.png" class="img-thumbnail img-responsive" />
                <li>In the same page ask to show the App Secret</li>
                <li>Do not forget to activate the APP in the left manu - Status & Review and turn on the APP by sliding the bar to the right</li>
                <img src="view/image/d_social_login/facebook/9-satus-&-review.png" class="img-thumbnail img-responsive" />
                <li>Fill in the App ID and App Secret in the Social Login settings tab for Facebook</li>
            </ol>
        </div>',
    
    'linkedin' =>
        '<h3 class="tab-title"><i class="fa fa-linkedin"></i> Setup Likedin login button</h3>
        <div class="tab-body">
            <ol>
                <li>Visit Linkedin developers page at <a href="http://developer.linkedin.com/" target="_blank">http://developer.linkedin.com/</a></li>
                <li>Sign in and in the top right menu select API keys</li>
                <li>Click Add new application</li>
                <img src="view/image/d_social_login/linkedin/1-start.png" class="img-thumbnail img-responsive" />
                <li>Fill in the data according to the screen shot</li>
                <img src="view/image/d_social_login/linkedin/2-create.png" class="img-thumbnail img-responsive" />
                <div class="bs-callout bs-callout-warning">
                    <h4>Your OAuth 2.0 Redirect urls URL</h4>
                    <p>' . HTTP_CATALOG . '</p>
                    <h4>Your Redirect URL for HTTPS</h4>
                    <p>' . HTTPS_CATALOG . '</p>
                </div>
                <li>Be sure to fill in OAuth 2.0 Redirect URLs and select  r_fullprofile, r_emailaddress, r_network and  r_contactinfo. Click save</li>
                <li>Fill in the API key and API Secret in the Social Login settings tab for Linkedin</li>
                <img src="view/image/d_social_login/linkedin/3-keys.png" class="img-thumbnail img-responsive" />
            </ol>
        </div>',
    
    'yahoo' =>
        '<h3 class="tab-title"><i class="fa fa-yahoo"></i> Setup Yahoo login button</h3>
        <div class="tab-body">
          <ol>
              <li>Visit Yahoo app developers page <a href="https://developer.yahoo.com/apps/create/" target="_blank"> https://developer.yahoo.com/apps/create/</a></li>
              <li>Click Create App</li>
              <img src="view/image/d_social_login/yahoo/1-create-app.png" class="img-thumbnail img-responsive" />
              <li>Fill in the Application Name, Application website, Application description, callback URL and permissions Social Directory (Profiles) - Read/Write Public and Private:</li>
              <div class="bs-callout bs-callout-warning">
                  <h4>Your Default callback URL</h4>
                  <p>' . HTTP_CATALOG . '</p>
                  <h4>Your Redirect URL for HTTPS</h4>
                  <p>' . HTTPS_CATALOG . '</p>
              </div>
              <img src="view/image/d_social_login/yahoo/2-fill-data.png" class="img-thumbnail img-responsive" />
              <li>Once the app is created, you will have a page with all the credentials on the right side.</li>
              <img src="view/image/d_social_login/yahoo/3-keys.png" class="img-thumbnail img-responsive" />
              <li>Fill in the OAuth consumer key and OAuth consumer secret in the Social Login settings tab for Yahoo. You are ready to go.</li>
          </ol>
        </div>'
    );