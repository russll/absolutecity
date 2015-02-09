<?php /* Smarty version 2.6.11, created on 2014-05-22 13:14:42
         compiled from mods/stat/_stat.html */ ?>
<?php echo '
<style>
	table.stat_table { padding: 10px; width: 250px;}
	table.stat_table tr {border: 1px solid black; padding: 10px;}
	table.stat_table tr.active {background-color: lightgoldenrodyellow; }
	table.stat_table tr.active td {padding:10px;}
	table.stat_table tr.disabled td {padding:10px;}
	table.stat_table tr.disabled {background-color: lightgray; }

	table.stat_table tr td {border: 1px solid black; padding: 6px;}
	table.stat_table tr td.type {font-weight: bold; width: 60%;}
	table.stat_table tr td.num {width: 40%; text-align: right;}


</style>
'; ?>

<div class="content">
	<div id="leftbar">
	  <h1 style="font-size: 14px;">&nbsp;Stats</h1>
		<div class="menu">
		    <ul>
							</ul>
		</div>
	</div>
	<div id="rightbar">
	    <form method="post" action="<?php echo $this->_tpl_vars['siteAdr']; ?>
">
		<h1 style="font-size: 14px;">Stat</h1><br />

                <table class="stat_table">
			<tr class="active"><td colspan="2">New accounts <span style="float:right">total[activated]</span></td></tr>
			<tr class="element">
				<td class="type">Current Month</td>
				<td class="num"><?php echo $this->_tpl_vars['stat']['new']['month']; ?>
</td>
			</tr>
			<tr class="element">
				<td class="type">Last 7 days</td>
				<td class="num"><?php echo $this->_tpl_vars['stat']['new']['last7days']; ?>
</td>
			</tr>
                        <tr class="element">
				<td class="type">This Week</td>
				<td class="num"><?php echo $this->_tpl_vars['stat']['new']['week']; ?>
</td>
			</tr>
            			<tr class="element">
				<td class="type">Yesterday</td>
				<td class="num"><?php echo $this->_tpl_vars['stat']['new']['yesterday']; ?>
</td>
			</tr>
			<tr class="element">
				<td class="type">Today</td>
				<td class="num"><?php echo $this->_tpl_vars['stat']['new']['today']; ?>
</td>
			</tr>
                        <tr class="element">
				<td class="type">All the times</td>
				<td class="num"><?php echo $this->_tpl_vars['stat']['new']['total']; ?>
</td>
			</tr>


			<tr class="disabled"><td colspan="2">New feeds... etc</td></tr>

		</table>

		
		</form>
	</div>
</div>