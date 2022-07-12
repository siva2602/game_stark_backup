<div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update Status')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample" method="POST" action="/users/status">
                    @csrf
                    <input type="hidden" name="id" id="stid">
                    <input type="hidden" name="status" id="st">

                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Reason')}}</label>
                                <div class="col-sm-9">
                                <textarea name="reason" class="form-control"  cols="40" rows="3"></textarea>
                                     </div>
                             </div>
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


<div class="modal fade" id="rewards" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update Status')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample" method="POST" action="/request/update">
                    @csrf
                                        
                    <input type="hidden" name="id" id="request_id">

                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Type')}}</label>
                                <div class="col-sm-9">
                                <select name="type" class="form-control" >
                                    <option value="Success">Success</option>
                                    <option value="Reject">Reject</option>
                                </select>
                           </div>
                    </div>

                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Remark')}}</label>
                                <div class="col-sm-9">
                                <textarea name="reason" class="form-control"  cols="10" rows="3" placeholder="youl recevie payment with in 2 days"></textarea>
                                     </div>
                    </div>
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Save')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        
        
        
  <!--add faq-->
  <div class="modal fade" id="faqmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Insert Data')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample" method="POST" action="/faq/create">
                    @csrf
                                        
                    <input type="hidden" name="id" id="request_id">

                    <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Question')}}</label>
                                    <div class="col-sm-9">
                                    <textarea name="question" class="form-control"  cols="10" rows="1"></textarea>
                                         </div>
                    </div>


                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Answer')}}</label>
                                <div class="col-sm-9">
                                <textarea name="answer" class="form-control"  cols="10" rows="3" placeholder="answer"></textarea>
                                     </div>
                    </div>
                    
                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Category')}}</label>
                                <div class="col-sm-9">
                                <select name="type" class="form-control" required>
                                    <option value="howto" >How to</option>
                                    <option value="faq" >Faq</option>
                                </select>
                           </div>
                    </div>
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        
  
<!-- update faq modal-->
 <!--add faq-->
  <div class="modal fade" id="faqupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update Faq')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample update" method="POST" action="/faq/update">
                    @csrf
                                        
                    <input type="hidden" name="id" id="id">

                <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Faq')}}</label>
                                <div class="col-sm-9">
                                <textarea name="question" class="form-control"  cols="10" rows="1" id="question"></textarea>
                                     </div>
                    </div>


                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Answer')}}</label>
                                <div class="col-sm-9">
                                <textarea name="answer" class="form-control"  cols="10" rows="3" placeholder="answer" id="answer"></textarea>
                                     </div>
                    </div>
                    
                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Category')}}</label>
                                <div class="col-sm-9">
                                <select name="type" id="type" class="form-control">
                                    <option value="howto" >How to</option>
                                    <option value="faq"  >Faq</option>
                                </select>
                           </div>
                    </div>
                   
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
      
 <!-- Add Promotion Banner-->
  <div class="modal fade" id="bannermodel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Banner Data')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample" method="POST" action="/banner/create" enctype= "multipart/form-data">
                    @csrf
                                        

                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Banner onClick Action')}}</label>
                                <div class="col-sm-12">
                                <select name="type" class="form-control" required>
                                    <option value="spin" >Spin Screen</option>
                                    <option value="scratch" >Scratch Screen</option>
                                    <option value="game" >Game Task Screen</option>
                                    <option value="video" >Video Task Screen</option>
                                    <option value="web" >Website Task Screen</option>
                                    <option value="link" >Link</option>
                                    <option value="refer" >Referral Screen</option>
                                    <option value="promo" >Promotion Screen</option>
                                   <option value="coin" >Coin Store Screen</option>

                                </select>
                           </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Url( Required only for Banner Action Link)</label>
                                    <div class="col-sm-12">
                                    <input type="text" name="link" class="form-control" />
                                         </div>
                    </div>
                    
                     <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Banner Type')}}</label>
                                <div class="col-sm-12">
                                <select name="bannertype" class="form-control" required>
                                      <option value="slide" >Home Screen Slide ( Height 200px*400px Width)</option>
                                    <option value="popup" >Popup (Height 400px*400px Width )</option>
                                </select>
                           </div>
                    </div>
                    
                    <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Select Banner</label>
                                    <div class="col-sm-12">
                                    <input type="file" name="icon" class="form-control" />
                                         </div>
                    </div>
                    
                    
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        
<!---update promotion banner-->
  <div class="modal fade modal" id="updatebanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Banner Data')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample-banner" method="POST" action="/banner/update" enctype= "multipart/form-data">
                    @csrf
                             
                    <input type="hidden" name="id" id="bannerid"/>                    
                    <input type="hidden" name="oldimage" id="oldimage"/>                    

                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Banner onClick Action')}}</label>
                                <div class="col-sm-12">
                                <select name="type" class="form-control" id="type"required>
                                    <option value="spin" >Spin Screen</option>
                                    <option value="scratch" >Scratch Screen</option>
                                    <option value="game" >Game Task Screen</option>
                                    <option value="video" >Video Task Screen</option>
                                    <option value="web" >Website Task Screen</option>
                                    <option value="link" >Link</option>
                                    <option value="refer" >Referral Screen</option>
                                    <option value="promo" >Promotion Screen</option>
                                    <option value="coin" >Coin Store Screen</option>

                                </select>
                           </div>
                    </div>
                    
                    <div class="form-group" id="divlink">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Url( Required only for Banner Action Link)</label>
                                    <div class="col-sm-12">
                                    <input type="text" name="link" id="link" class="form-control" />
                                         </div>
                    </div>
                    
                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Banner Type')}}</label>
                                <div class="col-sm-12">
                                <select name="bannertype" id="bannertype" class="form-control" required>
                                    <option value="slide" >Home Screen Slide ( Height 200px*400px Width)</option>
                                    <option value="popup" >Popup (Height 400px*400px Width )</option>
                                </select>
                           </div>
                    </div>
                    
                      <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Select Banner 400*400')}}</label>
                                <div class="col-sm-12">
                                    <input id="icon" type="file" class="form-control" name="icon" placeholder="Select">
                                </div>
                     </div>
                    
                    
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        
<!--// add user coin        -->
   <div class="modal fade" id="addcoins" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Add Coin')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample" method="POST" action="/user/addcoin">
                    @csrf
                    <input type="hidden" name="id" id="coinid">
                    
                     <div class="form-group" >
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Coins</label>
                                    <div class="col-sm-12">
                                    <input type="number" name="coin" class="form-control" placeholder="0"/>
                                         </div>
                    </div>

                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Reason')}}</label>
                                <div class="col-sm-9">
                                <textarea name="reason" class="form-control border-dark"  cols="40" rows="3" placeholder="Added By Admin"></textarea>
                                     </div>
                             </div>
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>     


 <div class="modal fade" id="sendnoti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Send Notification')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample" method="POST" action="/user/noti">
                    @csrf
                    <input type="hidden" name="id" id="notid">
                    <input type="hidden" name="type" value="user">
                   
                    <div class="form-group" >
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">Title</label>
                                    <div class="col-sm-12">
                                    <input type="text" name="title" class="form-control" placeholder="title"/>
                                         </div>
                    </div>
                    
                    <div class="form-group">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Message')}}</label>
                                <div class="col-sm-9">
                                <textarea name="message" class="form-control border-dark"  cols="40" rows="3" placeholder="Messagen"></textarea>
                                     </div>
                             </div>
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Send')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>   
        
        
  <!--add coinstore-->
  <div class="modal fade" id="csmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Fill Data')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample" method="POST" action="/coinstore/create">
                    @csrf
                                        

                    <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Package Title')}}</label>
                                    <div class="col-sm-9">
                                    <input name="package" type="text" class="form-control" placeholder="Title" required/>
                                         </div>
                    </div>

                    <div class="form-group">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Package Buy Price')}}</label>
                            <div class="col-sm-9">
                                <input name="amount" type="number" class="form-control" placeholder="Package Buy Price  eg 40,50,10" required/>
                            </div>
                    </div>
                    
                    
                <div class="form-group">
                          <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Currency ( Example USD,INR )')}}</label>
                            <div class="col-sm-9">
                                <input name="currency" type="text" class="form-control" placeholder="eg USD  " required/>
                            </div>
                    </div>
                    
                    <div class="form-group">
                          <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Coin ')}}</label>
                            <div class="col-sm-9">
                                <input type="number" name="coin" class="form-control" placeholder="After Purchase User Get Coin 50,100" required/>
                            </div>
                    </div>
                    
                    <div class="form-group">
                            <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Available in Country (Package will be Available only selected country)')}}</label>
                               <div class="col-sm-9">
                                 <input name="country" type="text" class="form-control" placeholder="Country code US,IN  for all country use this code ALL" required/>
                            </div>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        
  
<!-- update coinstore modal-->
  <div class="modal fade" id="csupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update Data')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample update" method="POST" action="/coinstore/update">
                    @csrf
                                        
                    <input type="text" name="id" id="csid">

                 <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Package Title')}}</label>
                                    <div class="col-sm-9">
                                    <input name="package" type="text" id="package" class="form-control" placeholder="Title" required/>
                                         </div>
                    </div>

                    <div class="form-group">
                          <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Package Buy Price')}}</label>
                            <div class="col-sm-9">
                                <input name="amount" type="number" id="amount" class="form-control" placeholder="Package Buy Price  eg 40,50,10" required/>
                            </div>
                    </div>
                    
                     <div class="form-group">
                          <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Currency ( Example USD,INR )')}}</label>
                            <div class="col-sm-9">
                                <input name="currency" id="currency" type="text" class="form-control" placeholder="eg USD " required/>
                            </div>
                    </div>
                    
                    <div class="form-group">
                          <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Coin ')}}</label>
                            <div class="col-sm-9">
                                <input type="number" name="coin" id="coin" class="form-control" placeholder="After Purchase User Get Coin 50,100" required/>
                            </div>
                    </div>
                    
                    <div class="form-group">
                            <label for="exampleInputEmail2" class="col-sm-12 col-form-label">{{ __('Available in Country (Package will be Available only selected country)')}}</label>
                               <div class="col-sm-9">
                                 <input name="country" type="text" id="country" class="form-control" placeholder="Country code US,IN  for all country use this code ALL" required/>
                            </div>
                    </div>
                   
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        
        
  <!--add quiz cat-->
  <div class="modal fade" id="quizcatmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Fill Data')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample" method="POST" action="/quiz-cat/create" enctype="multipart/form-data">
                    @csrf
                                        

                    <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Category Title')}}</label>
                                    <div class="col-sm-9">
                                    <input name="title" type="text" class="form-control" placeholder="Title" required/>
                                         </div>
                    </div>
                    
                    <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Desription')}}</label>
                                    <div class="col-sm-9">
                                    <input name="description" type="text" class="form-control" placeholder="Describe Category Detail max 2 lines" required/>
                                         </div>
                    </div>

                     <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Category Icon 200*200')}}</label>
                                <div class="col-sm-12">
                                    <input id="icon" type="file" class="form-control" name="icon" placeholder="Select">
                                </div>
                     </div>
                    

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        
  
<!-- update quiz cat modal-->
  <div class="modal fade" id="quizcatsupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterLabel">{{ __('Update Data')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body bg-white">
                    <form class="forms-sample update" method="POST" action="/quiz-cat/update" enctype="multipart/form-data">
                    @csrf
                                        
                    <input type="hidden" name="ids" id="quizcatid">
                    <input type="hidden" name="oldicon" id="caticon">

                    <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Category Title')}}</label>
                                    <div class="col-sm-9">
                                    <input name="title" id="cattitle" type="text" class="form-control" placeholder="Title" required/>
                                         </div>
                    </div>
                    
                    <div class="form-group">
                                    <label for="exampleInputEmail2" class="col-sm-3 col-form-label">{{ __('Desription')}}</label>
                                    <div class="col-sm-9">
                                    <input name="description" id="catdesc" type="text" class="form-control" placeholder="Describe Category Detail" required/>
                                         </div>
                    </div>

                     <div class="form-group row">
                                <label for="exampleInputConfirmPassword2" class="col-sm-12 col-form-label">{{ __('Category Icon 200*200')}}</label>
                                <div class="col-sm-12">
                                    <input id="icon" type="file" class="form-control" name="icon" placeholder="Select">
                                </div>
                     </div>
                   
                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>        
              
        