<?php
// author email: ugg.xchj@gmail.com
// ���������ѧϰ�ο������ṩ�κμ�����֤��
// ����ʹ�ñ��������ڷǷ��ô���Υ�ߺ���Ը���

class files
{
	public function setFileName($filename)
	{
		$this->filename = $filename;
	}
	public function fserialize($data)
	{
		$this->fileContent = serialize($data);

		if(!$fso=fopen($this->filename,'w'))
		{
			echo '�޷������ݿ��ļ�';
			return false;
		}

		if(!flock($fso,LOCK_EX)){//LOCK_NB,����������
			echo '�޷��������ݿ��ļ�';
			return false;
		}

		if(!fwrite($fso,$this->fileContent)){
			echo '�޷�д�뻺���ļ�';
			return false;
		}

		flock($fso,LOCK_UN);//�ͷ�����
		fclose($fso);
		return true;
	}

	public function funserialize()
	{
		if(!file_exists($this->filename)){
			echo '�޷���ȡ���ݿ��ļ�';
			return false;
		}
		//return unserialize(file_get_contents($cacheFile));
		$fso = fopen($this->filename, 'r');
		$this->fileContent = fread($fso, filesize($this->filename));
		fclose($fso);
		return unserialize($this->fileContent);
	}

	public function __construct()
	{
	}
	protected $filename="keys";
	protected $fileContent;

}
?>