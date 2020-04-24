<html>
 <body>
	<fieldset>
		<table>
 		<form action=make_lecture_keyword.php method="POST">
			<tr>
				<th>Keyword : </th>
				<td><input type="text" name="keyword"></td>
			</tr>
			<tr>
				<th>Weight : </th>
				<td><input type="number" min="0.00" max="10.00" step="any" name="key_weight"></td>				
			</tr>
			<tr>
				<td><input type="submit" value="키워드 생성하기"></td>
			</tr>
		</form>
		</table>
	</fieldset>
 </body>
</html>