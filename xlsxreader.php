<?
function readXlsxRows($path)
{
	$zip = new ZipArchive();
	if($zip->open($path) !== true) return array();

	$shared = array();
	$ssXml = $zip->getFromName('xl/sharedStrings.xml');
	if($ssXml !== false)
	{
		$ss = new SimpleXMLElement($ssXml);
		foreach($ss->si as $si)
		{
			if(isset($si->t))
			{
				$shared[] = (string)$si->t;
			}
			else
			{
				$text = '';
				foreach($si->r as $r) { $text .= (string)$r->t; }
				$shared[] = $text;
			}
		}
	}

	$sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
	if($sheetXml === false)
	{
		for($i=0;$i<$zip->numFiles;$i++)
		{
			$name = $zip->getNameIndex($i);
			if(strpos($name,'xl/worksheets/sheet')===0) { $sheetXml = $zip->getFromName($name); break; }
		}
	}
	$zip->close();
	if($sheetXml === false) return array();

	$sheet = new SimpleXMLElement($sheetXml);
	$rows = array();
	foreach($sheet->sheetData->row as $row)
	{
		$rowData = array();
		foreach($row->c as $c)
		{
			preg_match('/^([A-Z]+)/', (string)$c['r'], $m);
			$col = $m[1];
			$type = (string)$c['t'];
			$val = isset($c->v) ? (string)$c->v : '';
			if($type === 's')
			{
				$idx = (int)$val;
				$val = isset($shared[$idx]) ? $shared[$idx] : '';
			}
			$rowData[$col] = $val;
		}
		$rows[] = $rowData;
	}
	return $rows;
}
?>
