<?php

/**
 * @Project PaCorp 1x
 * @Author PaCorp Co.,Ltd (contact@pacorp.vn)
 * @Copyright (C) 2014 PaCorp Co.,Ltd. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 10/03/2010 10:51
 */

if( ! defined( 'NV_IS_FILE_ADMIN' ) ) die( 'Stop!!!' );

$sql = 'SELECT id, title, alias FROM ' . NV_PREFIXLANG . '_' . $mod_data . ' ORDER BY weight ASC';
$result = $db->query( $sql );
while( $row = $result->fetch() )
{
	$array_item[$row['id']] = array(
		'key' => $row['id'],
		'title' => $row['title'],
		'alias' => $row['alias'] . $global_config['rewrite_exturl'],
	);
}
