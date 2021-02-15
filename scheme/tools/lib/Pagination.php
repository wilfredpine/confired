<?php 
defined('BASE_DIRECTORY') OR exit('Direct access are not allowed');
/**
 * __________________________________________________________________
 *
 * ConfiRed - an opensource light & basic PHP MVC Framework
 * __________________________________________________________________
 *
 * MIT License
 * 
 * Copyright (c) 2020 Wilfred V. Pine
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package ConfiRed
 * @author Wilfred V. Pine <only.master.red@gmail.com>
 * @copyright Copyright 2020 (https://red.confired.com)
 * @link https://confired.com
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
 * -------------------------------------------------------
 *  Pagination
 * -------------------------------------------------------
 */
class Pagination {

    /*
	 * -------------------------------------------------------
	 *  Render Bootstrap
	 * -------------------------------------------------------
	 */
    public static function renderbootstrap($page, $total, $limit, $url) {
        
        $qoutient = $total/$limit;
        if($qoutient > round($qoutient)){
            $total_pages = round($qoutient) + 1;
        }else{ 
            $total_pages =  round($qoutient); 
        }
		
		if($total_pages >= 1) { ?>
            <!-- pagination -->
            <nav class="mt-2 ml-2 mb-0">
                <ul class="pagination pagination-sm">
                    <!-- Link of the first page -->
                    <li class="page-item <?php ($page <= 1 ? print 'disabled' : '')?>">
                        <a class="page-link" href="<?php print $url;?>/1" tabindex="-1" aria-disabled="true">First</a>
                    </li>
                    <!-- Link of the previous page -->
                    <li class="page-item <?php ($page <= 1 ? print 'disabled' : '')?>">
                        <a class="page-link" href="<?php print $url;?>/<?php ($page>1 ? print($page-1) : print 1)?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <!-- Links of the pages with page number -->
					<?php for($i=1; $i<=$total_pages; $i++) { ?>
                        <li class='page-item <?php ($i == $page ? print 'active' : '')?>'>
                            <a class="page-link" href='<?php print $url;?>/<?php echo $i;?>'><?php echo $i;?></a>
                        </li>
					<?php } ?>
                    <!-- Link of the next page -->
                    <li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
						<a class="page-link" href='<?php print $url;?>/<?php ($page < $total_pages ? print($page+1) : print $total_pages)?>'>Next</a>
					</li>
					<!-- Link of the last page -->
					<li class='page-item <?php ($page >= $total_pages ? print 'disabled' : '')?>'>
						<a class="page-link" href='<?php print $url;?>/<?php echo $total_pages;?>'>Last</a>
					</li>
                </ul>
            </nav>
            <!-- End pagination -->

		<?php }
	}
	
}

?>