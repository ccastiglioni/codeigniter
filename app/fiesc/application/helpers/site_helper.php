<?php

if ( ! function_exists('mensagem'))
{
    function mensagem($tp='topo')
    {
        $ci =& get_instance();
        $ci->load->database();

        $sql = "SELECT idContato, dsNome, dsContato, dtContato
                FROM ". $ci->db->dbprefix('contato') ."
                WHERE snLido = 'N'
                ORDER BY dtContato DESC, idContato DESC LIMIT 11";
        $row = $ci->db->query($sql);

        if ($row->num_rows() != 0)
        {
            $css   = 'success';
            if ($row->num_rows() > 10) {
                $css   = 'danger';
                $total  = '10+';
                $nova   = 'Voc&ecirc; tem mais de <span class="bold">10 novas</span> mensagens';
            } elseif ($row->num_rows() == 1){
                $total = $row->num_rows();
                $nova   = 'Voc&ecirc; tem <span class="bold">'.$total.' nova</span> mensagem';
            } else {
                if ($row->num_rows() > 8) {
                    $css   = 'warning';
                }
                $total = $row->num_rows();
                $nova   = 'Voc&ecirc; tem <span class="bold">'.$total.' novas</span> mensagens';
            }
                
            if ($tp == 'topo')
            {
                $html = '<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-'.$css.'">
                            '.$total.' </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    <h3>'.$nova.'</h3>
                                    <a href="'. base_url('painel/contatos') .'">todas</a>
                                </li>
                                <li>
                                    <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">';

                for($i = 0; $i < $row->num_rows(); $i++)
                {
                    $html.= '
                                        <li>
                                            <a href="'. base_url('painel/contatos/'.$row->row($i)->idContato) .'">
                                            <span class="subject" style="margin-left: 0px;">
                                            <span class="from">
                                            '.$row->row($i)->dsNome.' </span>
                                            <span class="time">'.dataHojeOntem($row->row($i)->dtContato).' </span>
                                            </span>
                                            <span class="message" style="margin-left: 0px;">
                                            '.character_limiter(strip_tags($row->row($i)->dsContato),80).'</span>
                                            </a>
                                        </li>';
                }

                $html.= '
                                    </ul>
                                </li>
                            </ul>
                        </li>';
            }
            elseif ($tp == 'menu') {
                $html = '<span class="badge badge-'.$css.'">'.$total.'</span>';
            } else {
                if ($total > 0)
                    $html =  '('. $total .')';
            }
                
            return $html;
        }
    }
}
 
function numberFormatPrecision($number, $precision = 2, $separator = '.')
{
    $numberParts = explode($separator, $number);
    $response = $numberParts[0];
    
    if (count($numberParts)>1 && $precision > 0) {
        $response .= $separator;
        $response .= substr($numberParts[1], 0, $precision);
    }
    return $response;
}

 
function regex_name($name){
    
$rexSafety = "/[\^<,\"@\/\{\}\(\)\*\$%\?=>:\|;#]+/i";
    if (preg_match($rexSafety, $name)) {
        $return= false;
    } else {
        $return= true;
    }

return $return;
}
?>
