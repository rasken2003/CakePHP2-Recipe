<?php
echo($this->Form->create('Search'));
echo($this->Form->label('text', 'フリーワード'));
echo($this->Form->text('text'));
echo($this->Form->label('is_active', '有効なもののみ'));
echo($this->Form->checkbox('is_active'));
echo($this->Form->end('検索'))
?>


<?php
echo($this->Paginator->numbers(array(
	'currentClass' => 'pager-active',
	'class'=>'pager',
	'modulus' => 10,
	'first' => '<<<',
	'last' => '>>>',
	'ellipsis' => '…', 
))); 
?>

<table>
<?php foreach ($articles as $article){ ?>
	<tr>
		<td><?php echo($article['Article']['title']); ?></td>
		<td>
			<?php if ($article['Article']['is_active']){ ?>
			○
			<?php } ?>
		</td>
	</tr>
<?php } ?>
</table>