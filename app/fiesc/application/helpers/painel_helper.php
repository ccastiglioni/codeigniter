<?php
if ( ! function_exists('valor'))
{
	function valor($value='')
	{
		$valor	= str_replace(".", "", $value);
		$valor	= str_replace(",", ".", $valor);

		return $valor;
	}
}

if ( ! function_exists('slug'))
{
	function slug($title,$tabela,$id,$edit='')
	{
		$ci =& get_instance();
		$ci->load->database();

		$dsSlug = convert_accented_characters($title);
		$dsSlug = url_title($dsSlug, 'dash', TRUE);

		if ($edit == '')
		{
			$sql = "SELECT ". $id ."
					FROM ". $ci->db->dbprefix($tabela) ."
					WHERE dsTitulo = '". $title ."'";
			$row = $ci->db->query($sql);

			if ($row->num_rows() == 0)
				return $dsSlug;
			else
				return $dsSlug .'-'. $row->row(0)->$id;
		}
		else
		{
			$nova_consulta	= 'N';

			$sql = "SELECT ". $id .", dsSlug
					FROM ". $ci->db->dbprefix($tabela) ."
					WHERE ". $id ." = '". $edit ."'";
			$row = $ci->db->query($sql);

			if ($row->num_rows() > 0)
			{
				if ($dsSlug == $row->row(0)->dsSlug)
					return $row->row(0)->dsSlug;
				else
				{
					$sql2 = "SELECT ". $id ."
						FROM ". $ci->db->dbprefix($tabela) ."
						WHERE dsTitulo = '". $title ."'";
					$row2 = $ci->db->query($sql2);

					if ($row2->num_rows() == 0)
						return $dsSlug;
					else
						return $dsSlug .'-'. $row2->row(0)->$id;
				}
			}
			else
				return $dsSlug .'-'. $edit;
		}
	}
}

if ( ! function_exists('imagem'))
{
	function imagem($path, $width, $height)
	{
		$config['upload_path']		= './assets/files/'. $path;
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= '1024';
		$config['max_width']		= $width;
		$config['max_height']		= $height;
		$config['encrypt_name']		= true;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload())
			return $this->upload->data();
	}
}

if ( ! function_exists('tamanhoImagem'))
{
	function tamanhoImagem($value='')
	{
		$ci =& get_instance();
		$ci->load->database();

		$sql = "SELECT nrLargura, nrAltura
				FROM ". $ci->db->dbprefix('imagem') ."
				WHERE dsPagina = '".$value."'
				LIMIT 1";
		$row = $ci->db->query($sql);

		if ($row->num_rows() != 0)
		{
			return '<small class="help-block">'.$row->row(0)->nrLargura.'x'.$row->row(0)->nrAltura.' pixels</small>';
		}
	}
}

if ( ! function_exists('pasta'))
{
	function pasta($value)
	{
		$path	= './assets/files/'. $value;
		$thumbs	= './assets/files/'. $value .'/thumbs';

		if( ! is_dir($path))
		{
			mkdir($path, 0755, TRUE);
				
			if( ! is_dir($thumbs))
			{
				mkdir($thumbs, 0755, TRUE);
			}
				
			if( ! is_dir($thumbs .'/p'))
			{
				mkdir($thumbs .'/p', 0755, TRUE);
			}
				
			if( ! is_dir($thumbs .'/m'))
			{
				mkdir($thumbs .'/m', 0755, TRUE);
			}
				
			if( ! is_dir($thumbs .'/g'))
			{
				mkdir($thumbs .'/g', 0755, TRUE);
			}
		}
	}
}

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
				$total	= '10+';
				$nova	= 'Voc&ecirc; tem mais de <span class="bold">10 novas</span> mensagens';
			} elseif ($row->num_rows() == 1){
				$total = $row->num_rows();
				$nova	= 'Voc&ecirc; tem <span class="bold">'.$total.' nova</span> mensagem';
			} else {
				if ($row->num_rows() > 8) {
					$css   = 'warning';
				}
				$total = $row->num_rows();
				$nova	= 'Voc&ecirc; tem <span class="bold">'.$total.' novas</span> mensagens';
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
?>