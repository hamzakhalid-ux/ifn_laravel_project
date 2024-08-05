{{-- @dd($all_privs) --}}
@if(session()->has('messages'))
    <div class="alert alert-success">
        {{ session()->get('messages') }}
    </div>
@endif
@if (!empty(session()->has('errors')))
    <div class="alert alert-danger">
        <ul>
            @foreach (session()->get('errors') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <h3>{{$postsCount ?? 0 }}</h3>

                <p>Posts</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('admin.post.list-post') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>{{$pagesCount ?? 0 }}</h3>

                <p>Pages</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('admin.page.list-page') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>{{$UsersCount ?? 0}}</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('admin.users.all-users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{$domainCount ?? 1}}</h3>

                <p>Domains</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{($login_user->role == 1) ?  route('admin.domain.list-domain') : '#' }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3>{{$CompanyCount ?? 1}}</h3>

                <p>Directory</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{($login_user->role == 1) ?  url('/admin/company/list-companies') : '#' }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <h3>{{$fundscount ?? 1}}</h3>

                <p>Funds</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{($login_user->role == 1) ?  url('admin/fund/list-funds') : '#' }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>{{$subscriber ?? 1}}</h3>

                <p>Subscribers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{($login_user->role == 1) ?  url('admin/subscriber/list-subscriber') : '#' }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        {{-- <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
                <!-- Custom tabs (Charts with tabs)-->
                <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                </div>
                </div>
                <!-- /.nav-tabs-custom -->

            </section>
        </div> --}}
      </section>
