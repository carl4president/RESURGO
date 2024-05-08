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
                <a>EMPLOYEE</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTS</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li class="header">MANAGE</li>
      
        <li><a href="attendance_history.php"><i class="fa fa-hourglass"></i><span>Attendance history</span></a></li>
        <li><a href="leave.php"><i class='fa fa-share-square'></i><span>Leave Requests</span></a></li>
        <li><a href="bonus.php"><i class="fa fa-money"></i><span>Bonus</span></a></li>
        <li><a href="overtime.php"><i class='fa fa-hourglass'></i><span>Overtime</span></a></li>
        <li><a href="deduction.php"><i class="fa fa-file-text"></i><span>Deduction</span></a></li>
        <li class="header">PRINTABLES</li>
        <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Payslip</span></a></li>
        <li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Schedule</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>