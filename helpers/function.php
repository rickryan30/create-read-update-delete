<?php
	function setGPC($val,$act)
	{
		if(!get_magic_quotes_gpc())
			$val = addslashes(trim($val));
		
		if($act == "display")
			$val = stripslashes($val);
		
		//return mysql_real_escape_string($val);
		return $val;
	}

	function DisplayPages($CurrentPage, $TotalPages, $formName, $linkClass)
	{
		if(!isset($formName))
			$formName = "frm1";
		
		if(strlen(trim($linkClass)) > 0)
			$myDispClass = " class=\"".trim($linkClass)."\" ";
		else
			$myDispClass = " ";
		
		$_SERVER["SCRIPT_NAME"];
		$Pagepos = strrpos($_SERVER["SCRIPT_NAME"],"/");
		$keyPage = substr($_SERVER["SCRIPT_NAME"],$Pagepos+1);
		
		echo "<script language=\"javascript\">";
		echo "function gotoPage(a,l,frm)";
		echo "{";
		echo "frm = eval(\"document.\"+frm);";
		echo "frm.action=l;";
		echo "frm.cpage.value=a;";
		echo "frm.submit();";
		echo "}";
		echo "</script>";
		
		if($TotalPages>1)
		{
			echo "<table width=\"99%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\" align=\"center\">
			  <tr> 
				<td align=\"center\"><b><font face=\"Verdana\" size=\"1\">Page $CurrentPage of $TotalPages</font></b></td>
			  </tr>
			</table>
			<br />";
			
			echo "<table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
					<tr> 
						<td valign=\"top\" align=\"center\"><font face=\"verdana\" size=\"2\">";
					if($CurrentPage>1)
					{
					
					echo "<a".$myDispClass."href=\"javascript:gotoPage('1','$keyPage','$formName');\" 
							title=\"Go to first page\"
							onmouseover=\"javascript:return window.status='Go to first page';\"
							onmouseout=\"javascript:return window.status='';\">First</a>&nbsp;|&nbsp;
							<a".$myDispClass."href=\"javascript:gotoPage('".($CurrentPage-1)."','$keyPage','$formName');\" 
							title=\"Go to previous page (".($CurrentPage-1).")\"
							onmouseover=\"javascript:return window.status='Go to previous page (".($CurrentPage-1).")';\"
							onmouseout=\"javascript:return window.status='';\">Previous</a>&nbsp;|&nbsp;";
					}
					echo "Go to Page 
							<form style=\"display:inline;\"><input type=\"text\" name=\"cpage\" size=\"5\" value='".$CurrentPage."' class=\"inputnowidth\">&nbsp;
							<input type=\"button\" class=\"btn btn-primary\" name=\"btngo\" value=\"Go\" onclick=\"gotoPage(this.form.cpage.value,'$keyPage', '$formName');\">&nbsp;&nbsp;</form>";
				if($CurrentPage<$TotalPages)
				{
					echo "<a".$myDispClass."href=\"javascript:gotoPage('".($CurrentPage+1)."','$keyPage','$formName');\" 
							title=\"Go to next page (".($CurrentPage+1).")\"
							onmouseover=\"javascript:return window.status='Go to next page (".($CurrentPage+1).")';\"
							onmouseout=\"javascript:return window.status='';\">Next</a>&nbsp;|&nbsp;
							<a".$myDispClass."href=\"javascript:gotoPage('".$TotalPages."','$keyPage','$formName');\" 
							title=\"Go to last page\"
							onmouseover=\"javascript:return window.status='Go to last page';\"
							onmouseout=\"javascript:return window.status='';\">Last</a>";
				}
				echo "</font></td>
				</tr>
				</table>	<br />";
		}
	}
?>