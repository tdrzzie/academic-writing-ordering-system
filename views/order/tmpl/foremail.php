<table border="0" cellpadding="5" width="92%" bgcolor="#B6B6B6">

    <tr>

      <td width="16%" bgcolor="#F0F0F0"><strong>Title:</strong></td>

      <td bgcolor="#FFFFFF"><?=$order['ordtopic'];?></td>

    </tr>

    <tr>

      <td width="16%" bgcolor="#F0F0F0"><strong>Paper type </strong></td>

      <td width="84%" bgcolor="#FFFFFF"><?=$order['doctype'];?></td>

    </tr>

    <tr>

      <td width="16%" bgcolor="#F0F0F0"><strong>Deadline</strong></td>

      <td bgcolor="#FFFFFF"><?=date('j, M Y H:i:s', strtotime($order['urgency']));?></td>

    </tr>

    <tr>

      <td width="16%" bgcolor="#F0F0F0"><strong>Paper format </strong></td>

      <td bgcolor="#FFFFFF"><?=$order['style'];?></td>

    </tr>

    <tr>

      <td width="16%" bgcolor="#F0F0F0"><strong>Course level </strong></td>

      <td bgcolor="#FFFFFF"><?=$order['level'];?></td>

    </tr>

    <tr>

      <td width="16%" bgcolor="#F0F0F0"><strong>Subject Area </strong></td>

      <td bgcolor="#FFFFFF"><?=$order['subject'];?></td>

    </tr>

    <tr>

      <td bgcolor="#F0F0F0"><strong># pages </strong></td>

      <td bgcolor="#FFFFFF"><?=$order['pages'];?></td>

    </tr>

    <tr>

      <td bgcolor="#F0F0F0"><strong>Spacing</strong></td>

      <td bgcolor="#FFFFFF"><?=$order['spacing'];?></td>

    </tr>

    <tr>

      <td bgcolor="#F0F0F0"><strong>Cost </strong></td>

      <td bgcolor="#FFFFFF"><?=$order['amount'];?></td>

    </tr>

    <tr>

      <td bgcolor="#F0F0F0"><strong># sources</strong></td>

      <td bgcolor="#FFFFFF"><?=$order['sources'];?></td>

    </tr>

    <tr>

      <td valign="top" bgcolor="#F0F0F0"><strong>Paper Details</strong></td>

      <td bgcolor="#FFFFFF"><?=$order['desciption'];?></td>

    </tr>

  </table>