<?php

namespace Drupal\cp22_saulnier_news_list\Manager;

interface NewsListManagerInterface {

  /**
   * This method provide a button to access on the news list page
   * @return array
   */
  public function getLinkButtonNewsList(): array ;

  /**
   * This method provide the news information built inside the breadcrumb
   * @return mixed
   */
  public function getNewsListNode() ;

  /**
   * Build the news node published sort by changed with a pager of 5 nodes in view mode teaser
   * @return array
   */
  public function getBuiltNewsNodeForNewsListPage(): array ;

  /**
   *  Build the news node published sort by changed with a pager of 5 nodes in view mode teaser
   *  This query is filtred by term and date
   * @param $termId
   * @param $date
   *
   * @return array
   */
  public function getBuiltNewsNodeForNewsListPageByTermId($termId, $date): array ;
}
