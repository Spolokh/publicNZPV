<?php
 /**
  *
  * Этот класс помогает интегрировать разбиение на страницы в PHP.
  *
  */
class Pagination
{
    protected $baseURL  = '';
    protected $total    = '';
    protected $limit    = 10;
    protected $numLinks     =  2;
    protected $currentPage  =  0;
    protected $firstLink    = 'Первая';
    protected $lastLink     = 'Последняя';
    protected $nextLink     = '<span class="fa fa-chevron-right" aria-hidden="true"></span>';
    protected $prevLink     = '<span class="fa fa-chevron-left" aria-hidden="true"></span>';
    protected $fullTagOpen  = '<ul class="pagination justify-content-center">';
    protected $fullTagClose = '</ul>';
    protected $firstTagOpen = '<li class="page-item">';
    protected $firstTagClose= '</li>';
    protected $lastTagOpen  = '<li class="page-item">';
    protected $lastTagClose = '</li>';
    protected $curTagOpen   = '<li class="page-item active">';
    protected $curTagClose  = '</li>';
    protected $nextTagOpen  = '<li class="page-item">';
    protected $nextTagClose = '</li>';
    protected $prevTagOpen  = '<li class="page-item">';
    protected $prevTagClose = '</li>';
    protected $numTagOpen   = '<li class="page-item">';
    protected $numTagClose  = '</li>';
    protected $showCount    = false;
    protected $currentOffset= 0;
    protected $queryStringSegment ='page';
    
    public function __construct( array $params = [] )
    {
        if (count($params) > 0){
            $this->initialize($params);        
        }
    }
     
    private function initialize( array $params = [] )
    {
        if (count($params) > 0){
            foreach ($params as $k => $v){
                if (isset($this->$k)){
                    $this->$k = $v;
                }
            }        
        }
    }
     
    /**
     * Генерируем ссылки на страницы
    */    
    public function createLinks()
    { 
        // Если общее количество записей 0, не продолжать
        if ($this->total == 0 || $this->limit == 0){
            return '';
        }

        // Считаем общее количество страниц
        $numPages = ceil($this->total / $this->limit);
        
        // Если страница только одна, не продолжать
        if ($numPages == 1){

            if ($this->showCount) {
                $info = 'Showing : ' . $this->total;
                return $info;
            } else {
                return '';
            }
        }
         
        // Определяем строку запроса
        $query_string_sep = (strpos($this->baseURL, '?') === FALSE) ? '?page=' : '&amp;page=';
        $this->baseURL = $this->baseURL.$query_string_sep;
        
        // Определяем текущую страницу
        $this->currentPage = $_GET[$this->queryStringSegment];
        
        if ( !is_numeric($this->currentPage) || $this->currentPage == 0 ){
            $this->currentPage = 1;
        }
        
        // Строковая переменная вывода контента
        $output = '';
         
        // Отображаем сообщение о ссылках на другие страницы
        if ($this->showCount){

            $currentOffset = ($this->currentPage > 1) ? ($this->currentPage - 1) * $this->limit:$this->currentPage;
            
            $info = 'Показаны элементы с ' .$currentOffset. ' по ' ;
            $info.= ( ($currentOffset + $this->limit) < $this->total ) ? ($this->currentPage * $this->limit) : $this->total;
            $info.= ' из ' . $this->total;
            
            $output.= $info;
        }
         
        $this->numLinks = (int) $this->numLinks;
         
        // Если номер страницы больше максимального значения, отображаем последнюю страницу
        if( $this->currentPage > $this->total )
        {
            $this->currentPage = $numPages;
        }
         
        $uriPageNum = $this->currentPage;
        
        // Рассчитываем первый и последний элементы 
        $start = (($this->currentPage - $this->numLinks) > 0) ? $this->currentPage - ($this->numLinks - 1) : 1;
        $stop  = (($this->currentPage + $this->numLinks) < $numPages) ? $this->currentPage + $this->numLinks : $numPages;
        
        // Выводим ссылку на первую страницу
        if( $this->currentPage > $this->numLinks ){
            $firstPageURL = str_replace($query_string_sep, '', $this->baseURL);
            $output.= $this->firstTagOpen .'<a class="page-link" href="' .$firstPageURL. '">' .$this->firstLink. '</a>'.$this->firstTagClose;
        }

        // Выводим ссылку на предыдущую страницу
        if ($this->currentPage != 1)
        {
            $i = ($uriPageNum - 1);
            
            if( $i == 0 ) {
                $i = '';
            }

            $output.= $this->prevTagOpen.'<a class="page-link" href="'.$this->baseURL.$i.'">'.$this->prevLink.'</a>'.$this->prevTagClose;
        }
        // Выводим цифровые ссылки
        for($loop = $start -1; $loop <= $stop; $loop++){
            $i = $loop;
            if($i >= 1){
                if( $this->currentPage == $loop ){
                    $output.= $this->curTagOpen .'<a class="page-link">' .$loop. '</a>' .$this->curTagClose;
                } else {
                    $output.= $this->numTagOpen .'<a class="page-link" href="'.$this->baseURL.$i.'">'.$loop.'</a>' . $this->numTagClose;
                }
            }
        }
        // Выводим ссылку на следующую страницу
        if( $this->currentPage < $numPages ){
            $i = ($this->currentPage + 1);
            $output.= $this->nextTagOpen.'<a class="page-link" href="'.$this->baseURL.$i.'">' .$this->nextLink. '</a>'.$this->nextTagClose;
        }
        // Выводим ссылку на последнюю страницу
        if(($this->currentPage + $this->numLinks) < $numPages){
            $i = $numPages;
            $output.= $this->lastTagOpen.'<a class="page-link" href="'.$this->baseURL.$i.'">' .$this->lastLink. '</a>'.$this->lastTagClose;
        }

        // Удаляем двойные косые
        $output = preg_replace("#([^:])//+#", "\1/", $output);
        // Добавляем открывающий и закрывающий тэги блока
        $output = $this->fullTagOpen . $output . $this->fullTagClose;

        return $output;        
    }

    public function __toString()
    {
        return $this->createLinks() ;
    }
}
