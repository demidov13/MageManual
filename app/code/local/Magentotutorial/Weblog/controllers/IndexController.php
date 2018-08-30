<?php
class Magentotutorial_Weblog_IndexController extends Mage_Core_Controller_Front_Action {

    public function testModelAction() {
        $params = $this->getRequest()->getParams();
        $blogpost = Mage::getModel('weblog/blogpost');
        echo("Loading the blogpost with an ID of ".$params['id']);
        $blogpost->load($params['id']);
        $data = $blogpost->getData();
        var_dump($data);
    }

    public function createNewPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->setTitle('Code Post!');
        $blogpost->setPost('This post was created from code!');
        $blogpost->save();
        echo 'post with ID ' . $blogpost->getId() . ' created';
    }

    public function editFirstPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->load(1);
        $blogpost->setTitle("The First post!");
        $blogpost->save();
        echo 'post edited';
    }

    public function deleteFirstPostAction() {
        $blogpost = Mage::getModel('weblog/blogpost');
        $blogpost->load(1);
        $blogpost->delete();
        echo 'post removed';
    }

    public function showAllBlogPostsAction() {
        $posts = Mage::getModel('weblog/blogpost')->getCollection();
        foreach($posts as $blogpost){
            echo '<h3>'.$blogpost->getTitle().'</h3>';
            echo nl2br($blogpost->getPost());
        }
    }

    public function testCollectionAction() {
        $thing_1 = new Varien_Object();
        $thing_1->setName('Richard');
        $thing_1->setAge(24);

        $thing_2 = new Varien_Object();
        $thing_2->setName('Jane');
        $thing_2->setLastName('Smith');
        $thing_2->setAge(12);

        $thing_3 = new Varien_Object();
        $thing_3->setName('Spot');
        $thing_3->setLastName('The Dog');
        $thing_3->setAge(7);

        $collection_of_things = new Varien_Data_Collection();
        $collection_of_things
            ->addItem($thing_1)
            ->addItem($thing_2)
            ->addItem($thing_3);

        // Перебор элементов коллекции
        foreach($collection_of_things as $thing) {
            var_dump($thing->getData());
        }

        // Первый и последний элементы коллекции
        var_dump($collection_of_things->getFirstItem()->getData());
        var_dump($collection_of_things->getLastItem()->getData());

        // Получение отдельного свойства элементов коллекции
        var_dump($collection_of_things->getColumnValues('name'));

        // Получение элементов коллекции, в которых name = Spot
        var_dump($collection_of_things->getItemsByColumnValue('name','Spot'));

          // Коллекция в формате XML
//        var_dump( $collection_of_things->toXml() );

//        var_dump($thing_1->getName());
//        var_dump($thing_2->getData());
    }
}

/*
 * Работа с коллекцией с помощью запросов ORM SQL
 * https://sebweo.com/ru/magento-dlya-php-mvc-razrabotchikov-kollektsii-varien-data-ch-9-11/
 */