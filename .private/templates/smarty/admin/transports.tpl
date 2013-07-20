{extends file="../base.tpl"}
{block name="mainbody"}
{if $errmsg}
<div class="errmsg">{$errmsg}</div>
{/if}
{if $transports}
<form method="post">
	<fieldset>
		<dl>
			<dt><label for="transport">Transport</label></dt>
			<dd>
				<select name="transport" id="transport">
					<option value="">--- Pick One ---</option>
					{foreach $transports as $row}
						{foreach $row as $name => $key}
						<!--
						{$key} -- {$name}
						-->
						<option value="{$key}"{if $key === $transport} selected="selected"{/if}>{$name}</option>
						{/foreach}
					{/foreach}
				</select>
			</dd>
		</dl>
	</fieldset>
	<input type="submit" value="Edit Transport" />
</form>
{/if}

<form method="post">
	<input type="hidden" name="transportid" value="{$transport}" />
	<fieldset>
		<dl>
			<dt><label for="name">Name</label></dt>
			<dd><input type="text" name="name" id="name" value="{$transportname}" /></dd>
		</dl>
		<dl>
			<dt><label for="type">Type</label></dt>
			<dd>
				<select name="type" id="type">
					<option value="">--- Pick One ---</option>
					<option value="local"{if $transporttype === 'local'} selected="selected"{/if}>Local File System</option>
					<option value="sftp"{if $transporttype === 'sftp'} selected="selected"{/if}>Secure FTP (SFTP)</option>
					<option value="ftp"{if $transporttype === 'ftp'} selected="selected"{/if}>FTP (Insecure!)</option>
				</select>
			</dd>
		</dl>
		<dl>
			<dt><label for="basedir">Base Directory</label></dt>
			<dd><input type="text" name="basedir" id="basedir" value="{$transportbasedir}" /></dd>
		</dl>
	</fieldset>
	<input type="submit" value="{if $name}Update{else}Add{/if} Transport" />
</form>
{/block}
