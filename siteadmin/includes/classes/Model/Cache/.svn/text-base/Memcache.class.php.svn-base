<?php
/**
 * Cache_Memcacheimp_Driver — Memcached driver with tags
 *
 * @author ssergy
 */
class Model_Cache_Memcache
{
    /**
     * Memcached pointer
     * @var object
     */
    protected $mMem;

    /**
     * compression flag
     * @var bool
     */
    protected $flags;

    /**
     * Cache lifetime
     * @var int
     */
    protected $mLifeTime;


    /**
     * Constructor
     */
    public function __construct( $life_time = 3600 )
    {

        if (!INIT_CACHE)
        {
            return;
        }

        include_once 'Model/Base/IzExcept.class.php';

        if ( ! extension_loaded('memcache'))
            throw new IzExcept('cache.extension_not_loaded', 'memcache');

        
        /** Set config */
        $config['servers'] = array
            (
                //array ( 'host' => 'localhost', 'port' => 11210, 'persistent' => FALSE ),
                array ( 'host' => 'localhost', 'port' => 11211, 'persistent' => FALSE )
            );

        /**
         * Enable cache data compression.
         */
        $config['compression'] = FALSE;


        $this -> mMem = new Memcache;
        $this -> flags = $config['compression'] ? MEMCACHE_COMPRESSED : FALSE;

        $servers = $config['servers'];
        
        foreach ($servers as $server)
        {
            // Additional options
            $server += array('host' => '127.0.0.1', 'port' => 11211, 'persistent' => FALSE);

            // Add connect to server
            if (!$this->mMem->addServer($server['host'], $server['port'], (bool) $server['persistent']))
            {
                /** error connect to server */
            }
        }

        $this -> mLifeTime = $life_time;
    }

    /**
     * not implemented interface
     *
     * @param $tag
     * @return exception
     */
    public function find($tag)
    {
        if (!INIT_CACHE)
        {
            return;
        }
        throw new BadMethodCallException();
    }

    /**
     * Возвращает значение ключа. В случае, если ключ не найден, или значения тэгов не совпадают (ключ сброшен) возвращает NULL.
     * Проверяет значения тэгов, хранящихся в ключах. В случае, если значения различаются ключ считается сброшенным.
     *
     * @param $id
     * @return NULL or data
     */
    public function get($id)
    {
        if (!INIT_CACHE)
        {
            return;
        }
        $value = $this->mMem->get($id);

        // Если ключ не найден - завершаемся и возвращает NULL
        if ($value === FALSE)
        {
            return NULL;
        }

        // Если у значения есть тэги - обрабатываем им и проверяем, не изменилось ли их значение
        if (!empty($value['tags']) && count($value['tags']) > 0)
        {
            $expired = false;

            foreach ($value['tags'] as $tag => $tag_stored_value)
            {
                // Получаем значение текущее значение тэга
                $tag_current_value = $this->get_tag_value ($tag);

                // И сравниваем это значение с тем, которое хранится в теле элемента кэша
                if ($tag_current_value != $tag_stored_value)
                {
                    // Если значение изменилось - считаем ключ не валидным
                    $expired = true;
                    break;
                }
            }

            // Если ключ не валидный - возвращаем NULL
            if ($expired)
            {
                return NULL;
            }
        }

        return $value['data'];
    }


    /**
     * "Удаляет" тэг. А именно, увеличивает значение ключа tag_$tag на 1.
     * Используется для сброса всех ключей с тэгом $tag.
     *
     * @param $tag
     * @return
     */
    public function delete_tag($tag)
    {
        if (!INIT_CACHE)
        {
            return;
        }
        $key = "tag_".$tag;
        $tag_value = $this->get_tag_value($tag);

        $this->set($key, microtime(true), NULL, 60*60*24*30);

        return true;
    }

    /**
     * Возвращает текущее значение тэга. В случае, если тэг не найден, создает его и возвращает значение 1.
     *
     * @param $tag
     * @return int
     */
    private function get_tag_value($tag)
    {
        if (!INIT_CACHE)
        {
            return;
        }
        $key = "tag_".$tag;

        $tag_value = $this->get($key);

        if ($tag_value === NULL)
        {
            $tag_value = microtime(true);
            $this->set($key, $tag_value, NULL, 60*60*24*30);

        }

        return $tag_value;
    }

    /**
     * Добавляет ключ id со значением data, метками tags.
     *
     * @param $id ключ
     * @param $data данные
     * @param $tags метки
     * @param $lifetime время жизни в секундах
     * @return bool
     */
    public function set($id, $data, array $tags = NULL, $lifetime = 0)
    {
        if (!INIT_CACHE)
        {
            return;
        }
        if (!$lifetime)
        {
            $lifetime = $this -> mLifeTime;
        }
        // Если заданы тэги — получаем их текущие значения в $key_tags
        if (!empty($tags))
        {
            $key_tags = array();

            foreach ($tags as $tag)
            {
                $key_tags[$tag] = $this->get_tag_value($tag);
            }

            // Запоминаем $key_tags в элемент tags массива
            $key['tags'] = $key_tags;
        }

        $key['data'] = $data;

        if ($lifetime !== 0)
        {
            $lifetime += time();
        }

        return $this->mMem->set($id, $key, $this->flags, $lifetime);
    }

    /**
     * Удаляет ключ $id
     *
     * @param $id ID ключа
     * @param $tag Не используется, но предусмотрен интерфейсом
     * @return bool
     */
    public function delete($id, $tag = FALSE)
    {
        if (!INIT_CACHE)
        {
            return;
        }
        if ($id == TRUE)
        {
            return $this->mMem->flush();
        }
        // Шлем запрос на удаление в драйвер memcached
        return $this->mMem->delete($id);
    }

    /**
     * Метод delete_expired не поддеживается, но предусмотрен интерфейсом
     *
     * @param $tag
     * @return exception
     */
    public function delete_expired()
    {
        if (!INIT_CACHE)
        {
            return;
        }
        // Метод не поддерживается
        throw new BadMethodCallException();
    }


    public function Flush()
    {
        return $this->mMem->flush();
    }
    
}/** Model_Cache_Memcache */
?>
