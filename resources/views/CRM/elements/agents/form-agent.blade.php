@include('CRM.elements.header-form-agent')
  <div class="row no-gutters">
    <div class="col-xl-8 pr-xl-2">
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="mb-0">Profile Settings</h5>
        </div>
        <div class="card-body bg-light">
          <form>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="first-name">First Name</label>
                  <input class="form-control" id="first-name" type="text" value="Anthony">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="last-name">Last Name</label>
                  <input class="form-control" id="last-name" type="text" value="Hopkins">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="email1">Email</label>
                  <input class="form-control" id="email1" type="text" value="anthony@gmail.com">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input class="form-control" id="phone" type="text" value="+44098098304">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="heading">Heading</label>
                  <input class="form-control" id="heading" type="text" value="Software Engineer">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label for="intro">Intro</label>
                  <textarea class="form-control" id="intro" name="intro" cols="30" rows="5">I am Anthony Hopkins & I am a software engineer currently working at Technext IT. I was born in New York, USA. I passed my childhood there. After acquiring Secondary School Certificate, I got admitted in Notre Dame College, one of the most renowned and established colleges of USA.</textarea>
                </div>
              </div>
              <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">Update </button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="card mb-3">
        <div class="card-header">
          <h5 class="mb-0">Experiences</h5>
        </div>
        <div class="card-body bg-light"><a class="mb-4 d-block d-flex align-items-center" href="#experience-form" data-toggle="collapse" aria-expanded="false" aria-controls="experience-form"><span class="circle-dashed"><span class="fas fa-plus"></span></span><span class="ml-3">Add new experience</span></a>
          <div class="collapse" id="experience-form">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="company">Company</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm" id="company" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="position">Position</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm" id="position" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="city">City</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm" id="city" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="exp-description">Description</label>
                  </div>
                  <div class="col-lg-7">
                    <textarea class="form-control form-control-sm" id="exp-description" rows="3"></textarea>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-7 offset-lg-3">
                  <div class="form-group form-check">
                    <input class="form-check-input" id="exampleCheck1" type="checkbox" checked="" />
                    <label class="form-check-label" for="exampleCheck1">I currently work here</label>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="exp-from">From</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm datetimepicker" id="exp-from" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="exp-to">To</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm datetimepicker" id="exp-to" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-7 offset-lg-3">
                    <button class="btn btn-primary" type="button">Save</button>
                  </div>
                </div>
              </div>
            </form>
            <hr class="border-dashed border-bottom-0 my-4" />
          </div>
          <div class="media"><a href="#!"> <img class="img-fluid" src="../assets/img/logos/g.png" alt="" width="50" /></a>
            <div class="media-body position-relative pl-3">
              <h6 class="fs-0 mb-0">Big Data Engineer<small class="fas fa-check-circle text-primary ml-1" data-toggle="tooltip" data-placement="top" title="Verified" data-fa-transform="shrink-4 down-2"></small>
              </h6>
              <p class="mb-1"> <a href="#!">Google</a></p>
              <p class="text-1000 mb-0">Apr 2012 - Present &bull; 6 yrs 9 mos</p>
              <p class="text-1000 mb-0">California, USA</p>
              <hr class="border-dashed border-bottom-0" />
            </div>
          </div>
          <div class="media"><a href="#!"> <img class="img-fluid" src="../assets/img/logos/apple.png" alt="" width="50" /></a>
            <div class="media-body position-relative pl-3">
              <h6 class="fs-0 mb-0">Software Engineer<small class="fas fa-check-circle text-primary ml-1" data-toggle="tooltip" data-placement="top" title="Verified" data-fa-transform="shrink-4 down-2"></small>
              </h6>
              <p class="mb-1"> <a href="#!">Apple</a></p>
              <p class="text-1000 mb-0">Jan 2012 - Apr 2012 &bull; 4 mos</p>
              <p class="text-1000 mb-0">California, USA</p>
              <hr class="border-dashed border-bottom-0" />
            </div>
          </div>
          <div class="media"><a href="#!"> <img class="img-fluid" src="../assets/img/logos/nike.png" alt="" width="50" /></a>
            <div class="media-body position-relative pl-3">
              <h6 class="fs-0 mb-0">Mobile App Developer<small class="fas fa-check-circle text-primary ml-1" data-toggle="tooltip" data-placement="top" title="Verified" data-fa-transform="shrink-4 down-2"></small>
              </h6>
              <p class="mb-1"> <a href="#!">Nike</a></p>
              <p class="text-1000 mb-0">Jan 2011 - Apr 2012 &bull; 1 yr 4 mos</p>
              <p class="text-1000 mb-0">Beaverton, USA</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-3 mb-xl-0">
        <div class="card-header">
          <h5 class="mb-0">Educations</h5>
        </div>
        <div class="card-body bg-light"><a class="mb-4 d-block d-flex align-items-center" href="#education-form" data-toggle="collapse" aria-expanded="false" aria-controls="education-form"><span class="circle-dashed"><span class="fas fa-plus"></span></span><span class="ml-3">Add new education</span></a>
          <div class="collapse" id="education-form">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="school">School</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm" id="school" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="degree">Degree</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm" id="degree" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="field">Field</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm" id="field" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="edu-from">From</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm datetimepicker" id="edu-from" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-3 text-lg-right">
                    <label class="mb-0" for="edu-to">To</label>
                  </div>
                  <div class="col-lg-7">
                    <input class="form-control form-control-sm datetimepicker" id="edu-to" type="text" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-7 offset-lg-3">
                    <button class="btn btn-primary" type="button">Save</button>
                  </div>
                </div>
              </div>
            </form>
            <hr class="border-dashed border-bottom-0 my-4" />
          </div>
          <div class="media"><a href="#!"> <img class="img-fluid" src="../assets/img/logos/stanford.png" alt="" width="50" /></a>
            <div class="media-body position-relative pl-3">
              <h6 class="fs-0 mb-0"> <a href="#!">Stanford University<small class="fas fa-check-circle text-primary ml-1" data-toggle="tooltip" data-placement="top" title="Verified" data-fa-transform="shrink-4 down-2"></small></a></h6>
              <p class="mb-1">Computer Science and Engineering</p>
              <p class="text-1000 mb-0">2010 - 2014 • 4 yrs</p>
              <p class="text-1000 mb-0">California, USA</p>
              <hr class="border-dashed border-bottom-0" />
            </div>
          </div>
          <div class="media"><a href="#!"> <img class="img-fluid" src="../assets/img/logos/staten.png" alt="" width="50" /></a>
            <div class="media-body position-relative pl-3">
              <h6 class="fs-0 mb-0"> <a href="#!">Staten Island Technical High School<small class="fas fa-check-circle text-primary ml-1" data-toggle="tooltip" data-placement="top" title="Verified" data-fa-transform="shrink-4 down-2"></small></a></h6>
              <p class="mb-1">Higher Secondary School Certificate, Science</p>
              <p class="text-1000 mb-0">2008 - 2010 &bull; 2 yrs</p>
              <p class="text-1000 mb-0">New York, USA</p>
              <hr class="border-dashed border-bottom-0" />
            </div>
          </div>
          <div class="media"><a href="#!"> <img class="img-fluid" src="../assets/img/logos/tj-heigh-school.png" alt="" width="50" /></a>
            <div class="media-body position-relative pl-3">
              <h6 class="fs-0 mb-0"> <a href="#!">Thomas Jefferson High School for Science and Technology<small class="fas fa-check-circle text-primary ml-1" data-toggle="tooltip" data-placement="top" title="Verified" data-fa-transform="shrink-4 down-2"></small></a></h6>
              <p class="mb-1">Secondary School Certificate, Science</p>
              <p class="text-1000 mb-0">2003 - 2008 &bull; 5 yrs</p>
              <p class="text-1000 mb-0">Alexandria, USA</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4 pl-xl-2">
      <div class="sticky-top sticky-sidebar">
        <div class="card mb-3 overflow-hidden">
          <div class="card-header">
            <h5 class="mb-0">Account Settings</h5>
          </div>
          <div class="card-body bg-light">
            <h6 class="font-weight-bold">Who can see your profile ?<span class="fs--2 ml-1 text-primary" data-toggle="tooltip" data-placement="top" title="Only The group of selected people can see your profile"><span class="fas fa-question-circle"></span></span></h6>
            <div class="pl-2">
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="view-settings" id="everyone" />
                <label class="custom-control-label" for="everyone">Everyone
                </label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="view-settings" id="my-followers" checked="checked" />
                <label class="custom-control-label" for="my-followers">My followers
                </label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="view-settings" id="only-me" />
                <label class="custom-control-label" for="only-me">Only me
                </label>
              </div>
            </div>
            <h6 class="mt-2 font-weight-bold">Who can tag you ?<span class="fs--2 ml-1 text-primary" data-toggle="tooltip" data-placement="top" title="Only The group of selected people can tag you"><span class="fas fa-question-circle"></span></span></h6>
            <div class="pl-2">
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="tag-settings" id="tag-everyone" />
                <label class="custom-control-label" for="tag-everyone">Everyone
                </label>
              </div>
              <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" name="tag-settings" id="group-members" checked="checked" />
                <label class="custom-control-label" for="group-members">Group Members
                </label>
              </div>
            </div>
            <hr class="border-dashed border-bottom-0">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="checkbox1" checked="checked" />
              <label class="custom-control-label" for="checkbox1">Allow users to show your followers
              </label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="checkbox2" checked="checked" />
              <label class="custom-control-label" for="checkbox2">Allow users to show your email
              </label>
            </div>
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="checkbox3" />
              <label class="custom-control-label" for="checkbox3">Allow users to show your experiences
              </label>
            </div>
            <hr class="border-dashed border-bottom-0">
            <div class="custom-control custom-switch">
              <input class="custom-control-input" type="checkbox" id="switch1" checked="checked" />
              <label class="custom-control-label" for="switch1">Make your phone number visible
              </label>
            </div>
            <div class="custom-control custom-switch">
              <input class="custom-control-input" type="checkbox" id="switch2" />
              <label class="custom-control-label" for="switch2">Allow user to follow you
              </label>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-header">
            <h5 class="mb-0">Billing Setting</h5>
          </div>
          <div class="card-body bg-light p-0">
            <div class="border-top border-bottom p-3">
              <h5>Plan</h5>
              <p class="fs-0"><strong>Developer</strong>- Unlimited private repositories</p><a class="btn btn-light btn-sm" href="#!">Update Plan</a>
            </div>
            <div class="border-bottom p-3">
              <h5>Payment</h5>
              <p class="fs-0">You have not added any payment.</p><a class="btn btn-light btn-sm" href="#!">Add Payment </a>
            </div>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-header">
            <h5 class="mb-0">Change Password</h5>
          </div>
          <div class="card-body bg-light">
            <form>
              <div class="form-group">
                <label for="old-password">Old Password</label>
                <input class="form-control" id="old-password" type="password">
              </div>
              <div class="form-group">
                <label for="new-password">New Password</label>
                <input class="form-control" id="new-password" type="password">
              </div>
              <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input class="form-control" id="confirm-password" type="password">
              </div>
              <button class="btn btn-primary btn-block" type="submit">Update Password</button>
            </form>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Danger Zone</h5>
          </div>
          <div class="card-body bg-light">
            <h5 class="fs-0">Transfer Ownership</h5>
            <p class="fs--1">Transfer this account to another user or to an organization where you have the ability to create repositories.</p><a class="btn btn-falcon-warning d-block" href="#!">Transfer</a>
            <hr class="border border-dashed my-4">
            <h5 class="fs-0">Delete this account</h5>
            <p class="fs--1">Once you delete a account, there is no going back. Please be certain.</p><a class="btn btn-falcon-danger d-block" href="#!">Deactivate Account</a>
          </div>
        </div>
      </div>
    </div>
  </div>