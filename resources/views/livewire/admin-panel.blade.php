<div>
    
  
 
  
      <section class="content">
        <nav>
          <i class="fas fa-bars menu-btn"></i>
          <a href="#" class="nav-link">Categories</a>
          <form action="#">
            <div class="form-input">
              <input type="search" placeholder="search..." />
              <button class="search-btn">
                <i class="fas fa-search search-icon"></i>
              </button>
            </div>
          </form>
  
          <input type="checkbox" hidden id="switch-mode" />
          <label for="switch-mode" class="switch-mode"></label>
  
          <a href="#" class="notification">
            <i class="fas fa-bell"></i>
            <span class="num">28</span>
          </a>
  
          <a href="#" class="profile">
            <img src="profile.png" alt="" />
          </a>
        </nav>
  
        <main>
          <div class="head-title">
            <div class="left">
              <h1>Overview Panel</h1>
              <ul class="breadcrumb">
                <li>
                  <a href="#">Dashboard</a>
                </li>
                <i class="fas fa-chevron-right"></i>
                <li>
                  <a href="#" class="active">Overview Panel</a>
                </li>
              </ul>
            </div>
            
            <a href="#" class="download-btn">
              <i class="fas fa-globe"></i>
              <span class="text">View Website</span>
            </a>
          </div>
  
          <div class="box-info">
            <li>
              <i class="fas fa-chart-line"></i>
              <span class="text">
                <h3>75%</h3>
                <p>Performance</p>
              </span>
            </li>
            <li>
              <i class="fas fa-users"></i>
              <span class="text">
                <h3>50K</h3>
                <p>Active Users</p>
              </span>
            </li>
            <li>
              <i class="fas fa-hand-holding-usd"></i>
              <span class="text">
                <h3>$1.2M</h3>
                <p>Revenue</p>
              </span>
            </li>
          </div>
  
          <div class="table-data">
            <div class="order">
              <div class="head">
                <h3>See Reports</h3>
                <i class="fas fa-search"></i>
                <i class="fas fa-filter"></i>
              </div>
  
              <div class="chart">
                <div class="bar" style="width: 80%; background: #4caf50;">80%</div>
                <div class="bar" style="width: 60%; background: #2196f3;">60%</div>
                <div class="bar" style="width: 90%; background: #ff9800;">90%</div>
                <div class="bar" style="width: 70%; background: #f44336;">70%</div>
              </div>
            </div>
  
            <div class="todo">
              <div class="head">
                <h3>Your Company Info</h3>
              </div>
            
              <form>
                <div class="form-group">
                  <label for="company-name">Company Name</label>
                  <div id="company-name" class="info-box"></div>
                </div>
            
                <div class="form-group">
                  <label for="company-color">Company Theme</label>
                  <div id="company-color" class="info-box"></div>
                </div>
            
                <div class="form-group">
                  <label for="company-address">Company Address</label>
                  <div id="company-address" class="info-box"></div>
                </div>
            
                <div class="form-group">
                  <label for="company-phone">Phone Number</label>
                  <div id="company-phone" class="info-box"></div>
                </div>
             </form>
            </div>
            
            <div>
              <div class="pie-chart"></div>
              <div class="legend">
                <div><span class="color-box red"></span>Red-Orange (25%)</div>
                <div><span class="color-box blue"></span>Blue (25%)</div>
                <div><span class="color-box green"></span>Green (25%)</div>
                <div><span class="color-box yellow"></span>Yellow (25%)</div>
              </div>
            </div>
            <div class="todo">
              <div class="head">
                <h3>Manage Company Info</h3>
              </div>
  
              <form>
                <div class="form-group">
                  <label for="company-name">Company Name</label>
                  <input type="text" id="company-name" placeholder="Enter company name" />
                </div>
  
                <div class="form-group">
                  <label for="company-color">Company Color</label>
                  <input type="color" id="company-color" />
                </div>
  
                <div class="form-group">
                  <label for="company-address">Company Address</label>
                  <input type="text" id="company-address" placeholder="Enter company address" />
                </div>
  
                <div class="form-group">
                  <label for="company-phone">Phone Number</label>
                  <input type="tel" id="company-phone" placeholder="Enter phone number" />
                </div>
  
                <button type="submit" class="btn-submit">Save Changes</button>
              </form>
            </div>
            <div class="container">
              <canvas id="trafficChart" width="400" height="200"></canvas>
            </div>
          </div>
        </main>
      </section>
      
  
  
</div>
