$('input[name="nome"]').mask('Z',{translation: {'Z': {pattern: /[a-zA-Z ]/, recursive: true}}});
$('input[name="cpf"]').mask('000.000.000-00');
$('input[name="codigo"]').mask('000');
$('input[name="dataPrevista"]').mask('00/00/0000');
$('input[name="valorPrevisto"]').mask('000.000.000.000.000,00', {reverse: true});
$('input[name="dataReal"]').mask('00/00/0000');
$('input[name="valorReal"]').mask('000.000.000.000.000,00', {reverse: true});
 