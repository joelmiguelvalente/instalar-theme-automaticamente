{foreach from=$tsTemas item=tema}
<div class="col-md-4">
	<div class="card">
		<div class="card-body">
			<div class="mx-auto d-block">
				<img style="object-fit:cover;" class="rounded mx-auto d-block" src="{$tema.t_url}/screenshot.png" alt="Previa del tema">
				<h5 class="text-sm-center mt-2 mb-1">{if $tsConfig.tema_id == $tema.tid}<i class="fas fa-check" title="En uso"></i> {/if}{$tema.t_name}</h5>
			</div>
			<hr>
			<div class="card-text text-sm-center">
				<div class="btn-group btn-group-sm">
					<a class="btn btn-info" href="?act=editar&tid={$tema.tid}">Editar</a>
					{if $tsConfig.tema_id == $tema.tid}
					{else}
					<a class="btn btn-success" href="?act=usar&tid={$tema.tid}&tt={$tema.t_name}">Activar</a>
					{if $tema.tid != 1}
					<a class="btn btn-danger" href="?act=borrar&tid={$tema.tid}&tt={$tema.t_name}">Eliminar</a>
					{/if}
					{/if}
				</div>
			</div>
		</div>
	</div>
</div>
{/foreach}
