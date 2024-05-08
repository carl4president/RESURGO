<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTS</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">MANAGE</li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Recruitment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="recruitment.php"><i class="fa fa-circle-o"></i> Applications</a></li>
            <li><a href="interview.php"><i class="fa fa-circle-o"></i> Interviewee List</a></li>
            <li><a href="vacancy.php"><i class="fa fa-circle-o"></i> Vacancy</a></li>
            <li><a href="recruitment_archive.php"><i class="fa fa-circle-o"></i> Application Archive</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
          <i class="fa fa-calendar"></i>
            <span>Attendance and Leave</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="attendance.php"><i class="fa fa-circle-o"></i><span>Attendance</span></a></li>
          <li><a href="leave.php"><i class="fa fa-circle-o"></i><span>Leave Request</span></a></li>
          <li><a href="leave_accepted.php"><i class="fa fa-circle-o"></i><span>Leave Accepted</span></a></li> 
          <li><a href="leave_rejected.php"><i class="fa fa-circle-o"></i><span>Leave Rejected</span></a></li>   
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Employees</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="employee.php"><i class="fa fa-circle-o"></i> Employee List</a></li>
            <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Overtime</a></li>
            <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Schedules</a></li>
            <li><a href="employee_archive.php"><i class="fa fa-circle-o"></i> Employee Archive</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span> Bonus</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="bonus.php"><i class="fa fa-circle-o"></i> Employee Bonus</a></li>
            <li><a href="bonus_list.php"><i class="fa fa-circle-o"></i> Bonus List</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-text"></i>
            <span>Deductions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="deduction_employee.php"><i class="fa fa-circle-o"></i> Employee Deduction List</a></li>
            <li><a href="deduction.php"><i class="fa fa-circle-o"></i> Deductions List</a></li>
          </ul>
        </li>
        <li><a href="position.php"><i class="fa fa-suitcase"></i><span>Positions</span></a></li>
        <li class="header">PRINTABLES</li>
        <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Payroll</span></a></li>
        <li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Schedule</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>