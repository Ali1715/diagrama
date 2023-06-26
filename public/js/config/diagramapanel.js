import * as joint from 'jointjs';


// Función para crear una caja de clase
function createClassBox(x, y, width, height, name, attributes, methods) {
  const classBox = new joint.shapes.uml.Class({
    position: { x, y },
    size: { width, height },
    name,
    attributes,
    methods
  });

  return classBox;
}

// Crear el lienzo
const paper2 = new joint.dia.Paper({
  el: document.getElementById('diagram'),
  width:  '100%',
  height: 100,
  justify: 'space-between',
  display: 'flex',
  gridSize: 10,
  drawGrid: true ,// default pattern (dot) with default settings

  
});
const paper = new joint.dia.Paper({
  el: document.getElementById('diagram2'),
  width:  '100%',
  height: 10000,
  justify: 'space-between',
  display: 'flex',
  model: new joint.dia.Graph(),
  gridSize: 10,
  defaultLink: new joint.shapes.uml.Association,
  drawGrid: true ,// default pattern (dot) with default settings

  drawGrid: 'mesh', // pre-defined pattern with default settings
  drawGrid: { name: 'mesh', args: { color: 'black' }},
  
  drawGrid: {
      name: 'doubleMesh',
      args: [
          { color: 'blcak', thickness: 1 }, // settings for the primary mesh
          { color: 'black', scaleFactor: 5, thickness: 1   } //settings for the secondary mesh
  ]}
});

// Obtener los datos del classBox desde la vista de Laravel
const classBoxData = Class;

// Crear el classBox con los datos recibidos
const classBox = createClassBox(
  classBoxData.x,
  classBoxData.y,
  classBoxData.width,
  classBoxData.height,
  classBoxData.name,
  classBoxData.attributes,
  classBoxData.methods
);


// Crea un objeto para realizar el seguimiento del diagrama seleccionado
let selectedDiagram = null;
let selecCopy=null;


// Función para crear una copia del diagrama seleccionado
function createCopy() {


  if (selectedDiagram) {
    const clone = selectedDiagram.clone();
    clone.translate(20, 20); // Ajusta la posición de la copia
    paper.model.addCell(clone);
  }
}
//importar paper-grid from rappid.js

// Evento de clic en los elementos del diagrama
paper2.on('element:pointerclick', function(elementView) {
  const element = elementView.model;
  selectedDiagram = element;
});

paper.on('element:pointerclick', function(elementView) {
  const element = elementView.model;
  selecCopy = element;
});


const link = new joint.shapes.standard.Link({
  source: { id: classBox.id },
  target: { id: classBox.id },
  attrs: {
    line: { stroke: 'black' }
  },
  sourceMultiplicity: '1',
  targetMultiplicity: '0..N'
});

// Variables para almacenar los IDs de los ClassBox seleccionados
let sourceId = null;
let targetId = null;

// Maneja el evento de clic en los elementos del diagrama
paper.on('cell:pointerclick', function(cellView, evt) {
    const cell = cellView.model;

    // Comprueba si el elemento clicado es una instancia de ClassBox
    if (cell instanceof joint.shapes.uml.Class) {
        // Verifica si es el primer ClassBox seleccionado (source)
        if (sourceId === null) {
            sourceId = cell.id;
            console.log('source:', sourceId);
        } else {
            // Verifica si es el segundo ClassBox seleccionado (target)
            targetId = cell.id;
            console.log('target:', targetId);

            // Crea el enlace con los IDs de source y target
            const link = new joint.shapes.uml.Association({
                source: { id: sourceId },
                target: { id: targetId },
          
            });

            // Añade el enlace al lienzo
            paper.model.addCell(link);

            // Reinicia las variables para el siguiente enlace
            sourceId = null;
            targetId = null;
        }
    }
});
const newStyleOptions = {
  fill: 'blue',
  stroke: 'red',
  strokeWidth: 2
};


// Escucha el evento de clic en el enlace
paper.on('link:options', function(linkView, evt) {
  const link = linkView.model;
  const linkId = link.id;
  console.log('Enlace seleccionado:', linkId);

   // Cambia el tipo de flecha del enlace
   link.prop('target/markerType', 'path');
   link.prop('target/markerPath', 'M 10 -5 0 0 10 5 Z');
   link.attr('line/strokeWidth', 2);
  // Actualiza el enlace en el diagrama
  linkView.update(link, { updateLinkVertices: true });
  });


  //*********************************************************************************** */
// Declarar la variable selectedClassBox fuera de los eventos
let selectedClassBox;

// Función para cargar los datos del ClassBox seleccionado en los campos de entrada
function loadClassBoxData() {

    // Obtener el contenedor de atributos
  
 
const attributesContainer = document.getElementById('attributesContainer');

const methodsContainer = document.getElementById('methodsContainer');
// Limpiar el contenedor de atributos
attributesContainer.innerHTML = '';
methodsContainer.innerHTML='';

  // Obtener los campos de entrada
  const classBoxNameInput = document.getElementById('classBoxName');
  const classBoxAttributesInput = document.getElementById('classBoxAttributes');
  const classBoxMethodsInput = document.getElementById('classBoxMethods');

  // Llenar los campos de entrada con los atributos existentes del ClassBox
  classBoxNameInput.value = selectedClassBox.get('name') || '';
  classBoxAttributesInput.value = selectedClassBox.get('attributes') || '' ;
  classBoxMethodsInput.value = selectedClassBox.get('methods') || '';

  // Obtener los atributos existentes del ClassBox
  const attributes = selectedClassBox.get('attributes') || [];
  const methods = selectedClassBox.get('methods') || [];

  // Crear campos de entrada para cada atributo existente

 
forEach(attribute => {
    const attributeInput = document.createElement('input');
    attributeInput.
   
type = 'text';
    attributeInput.

value = attribute;
    attributesContainer.appendChild(attributeInput);
  });
  forEach(method => {
    const methodInput = document.createElement('input');
    methodInput.
   
type = 'text';
methodInput.

value = method;
methodsContainer.appendChild(methodsInput);
  });
}

// Función para agregar un campo de entrada para un nuevo atributo
function addAttributeInput() {
  
 
  const attributesContainer = document.getElementById('attributesContainer');
  
  
const attributeInput = document.createElement('input');
attributeInput.type = 'text';
attributeInput.placeholder = 'Atributo';
attributesContainer.appendChild(attributeInput);
}  
// Función para agregar un campo de entrada para un nuevo atributo
function methodsInput() {
  
 
  const methodsContainer = document.getElementById('methodsContainer');
  
  
const methodInput = document.createElement('input');
methodInput.type = 'text';
methodInput.placeholder = 'Atributo';
methodsContainer.appendChild(methodInput);
} 

// Función para aplicar los cambios al ClassBox seleccionado
function applyChanges() {

  
  // Obtener los campos de entrada
  const classBoxNameInput = document.getElementById('classBoxName');
  const attributesContainer = document.getElementById('attributesContainer');
//  const classBoxAttributesInput = document.getElementById('classBoxAttributes');
  //const classBoxMethodsInput = document.getElementById('classBoxMethods');
  const methodsContainer = document.getElementById('methodsContainer');

  // Verificar que se haya seleccionado un ClassBox
  if (selectedClassBox instanceof joint.shapes.uml.Class) {
    // Actualizar los atributos del ClassBox con los valores de los campos de entrada
    selectedClassBox.prop('name', classBoxNameInput.value);
    //selectedClassBox.prop('attributes', classBoxAttributesInput.value);
    //selectedClassBox.prop('methods', classBoxMethodsInput.value);

// Obtener los valores de los campos de entrada de atributos
const attributeInputs = attributesContainer.getElementsByTagName('input');
const attributes = Array.from(attributeInputs).map(input => input.value);

selectedClassBox.prop('attributes', attributes);

// Obtener los valores de los campos de entrada de atributos
const methodInputs = methodsContainer.getElementsByTagName('input');
const methods = Array.from(methodInputs).map(input => input.value);

selectedClassBox.prop('methods', methods);

    // Actualizar la vista del ClassBox en el diagrama
    selectedClassBox.findView(paper).update();
  }
}

// Asignar el evento de clic al botón de aplicar cambios
const applyButton = document.getElementById('updateClassBox');
applyButton.addEventListener('click', applyChanges);


// Asignar el evento de clic al botón de agregar atributo
const addAttributeButton = document.getElementById('addAttributeButton');
addAttributeButton.addEventListener('click', addAttributeInput);

//Asignar el evento de clic al botón de agregar atributo
const methodsButton = document.getElementById('methodsButton');
methodsButton.addEventListener('click', methodsInput);

// Capturar la selección del ClassBox
paper.on('cell:pointerclick', function(cellView) {
  const cell = cellView.model;
  selectedClassBox = cell;

  if (selectedClassBox instanceof joint.shapes.uml.Class) {
    // Cargar los datos del ClassBox seleccionado en los campos de entrada
    loadClassBoxData();
  }
});


//************************************************************* */
// Agregar evento al seleccionar la punta del enlace
paper.on('link:pointerclick', function(linkView, evt) {
  // Obtener el enlace sele ccionado
  // Obtener las coordenadas del punto de origen del enlace
const sourcePoint = linkView.sourcePoint;

// Calcular la posición del campo de entrada de texto en función del punto de origen del enlace
const sourceMultiplicityInput = document.createElement('input');
sourceMultiplicityInput.style.position = 'absolute';
sourceMultiplicityInput.style.left = sourcePoint.x + 'px';//130
sourceMultiplicityInput.style.top = sourcePoint.y+410 + 'px';//460
sourceMultiplicityInput.style.width = '80px';
sourceMultiplicityInput.style.height = '20px';
sourceMultiplicityInput.style.padding = '2px';
sourceMultiplicityInput.style.fontFamily = 'Arial, sans-serif';
sourceMultiplicityInput.style.fontSize = '12px';

// Agregar el campo de entrada de texto al cuerpo del documento
document.body.appendChild(sourceMultiplicityInput);
// Obtener las coordenadas del punto de origen del enlace
const targetPoint = linkView.targetPoint;

// Calcular la posición del campo de entrada de texto en función del punto de origen del enlace
const targetMultiplicityInput = document.createElement('input');
targetMultiplicityInput.style.position = 'absolute';
targetMultiplicityInput.style.left = targetPoint.x + 'px';
targetMultiplicityInput.style.top = targetPoint.y+410 + 'px';
targetMultiplicityInput.style.width = '80px';
targetMultiplicityInput.style.height = '20px';
targetMultiplicityInput.style.padding = '2px';
targetMultiplicityInput.style.fontFamily = 'Arial, sans-serif';
targetMultiplicityInput.style.fontSize = '12px';

// Agregar el campo de entrada de texto al cuerpo del documento
document.body.appendChild(targetMultiplicityInput);


  // Agregar evento de cambio al campo de entrada de texto de la multiplicidad del origen
  sourceMultiplicityInput.addEventListener('input', function() {
    // Obtener el valor del campo de entrada de texto de la multiplicidad del origen
    const sourceMultiplicity = sourceMultiplicityInput.value;

    // Establecer la multiplicidad del origen en el enlace
    link.prop('sourceMultiplicity', sourceMultiplicity);

    // Actualizar la vista del enlace
    linkView.update();
  });

  // Agregar evento de cambio al campo de entrada de texto de la multiplicidad del origen
sourceMultiplicityInput.addEventListener('keydown', function(event) {
  // Verificar si se presionó la tecla Enter (código de tecla: 13)
  if (event.keyCode === 13) {
    // Evitar que se ejecute la acción por defecto del Enter (por ejemplo, enviar un formulario)
    event.preventDefault();

    // Obtener el valor del campo de entrada de texto de la multiplicidad del origen
    const sourceMultiplicity = sourceMultiplicityInput.value;

    // Establecer la multiplicidad del origen en el enlace
    link.prop('sourceMultiplicity', sourceMultiplicity);

    // Actualizar la vista del enlace
    linkView.update();

    // Mostrar la multiplicidad del origen en la pantalla
    const sourceTextElement = document.createElement('div');
    sourceTextElement.innerText = sourceMultiplicity;
    sourceTextElement.style.position = 'absolute';
    sourceTextElement.style.left = sourcePoint.x+10 + 'px';
    sourceTextElement.style.top = sourcePoint.y+404 + 'px';
    sourceTextElement.style.cursor = 'move'; // Establecer el cursor como "move" para indicar que el elemento es arrastrable
document.body.appendChild(sourceTextElement);

// Variables para almacenar la posición inicial del arrastre
let initialX, initialY;

// Función para iniciar el arrastre
function startDrag(event) {
  initialX = event.clientX - parseInt(sourceTextElement.style.left);
  initialY = event.clientY - parseInt(sourceTextElement.style.top);
  document.addEventListener('mousemove', drag);
  document.addEventListener('mouseup', endDrag);
}

// Función para arrastrar el elemento
function drag(event) {
  const newX = event.clientX - initialX;
  const newY = event.clientY - initialY;
  sourceTextElement.style.left = newX + 'px';
  sourceTextElement.style.top = newY + 'px';
}

// Función para finalizar el arrastre
function endDrag() {
  document.removeEventListener('mousemove', drag);
  document.removeEventListener('mouseup', endDrag);
}

// Agregar evento de clic al elemento de texto de la multiplicidad del origen
sourceTextElement.addEventListener('mousedown', startDrag);
    // Remover el campo de entrada de texto del origen del documento
    document.body.removeChild(sourceMultiplicityInput);
  }
});

// Agregar evento de cambio al campo de entrada de texto de la multiplicidad del destino
targetMultiplicityInput.addEventListener('keydown', function(event) {
  // Verificar si se presionó la tecla Enter (código de tecla: 13)
  if (event.keyCode === 13) {
    // Evitar que se ejecute la acción por defecto del Enter (por ejemplo, enviar un formulario)
    event.preventDefault();

    // Obtener el valor del campo de entrada de texto de la multiplicidad del destino
    const targetMultiplicity = targetMultiplicityInput.value;

    // Establecer la multiplicidad del destino en el enlace
    link.prop('targetMultiplicity', targetMultiplicity);

    // Actualizar la vista del enlace
    linkView.update();

    // Mostrar la multiplicidad del destino en la pantalla
    const targetTextElement = document.createElement('div');
    targetTextElement.innerText = targetMultiplicity;
    targetTextElement.style.position = 'absolute';
    targetTextElement.style.left = targetPoint.x  + 'px';
    targetTextElement.style.top = targetPoint.y+410  + 'px';
    targetTextElement.style.cursor = 'move'; // Establecer el cursor como "move" para indicar que el elemento es arrastrable
    document.body.appendChild(targetTextElement);
    
    // Variables para almacenar la posición inicial del arrastre
    let initialX, initialY;
    
    // Función para iniciar el arrastre
    function startDrag(event) {
      initialX = event.clientX - parseInt(targetTextElement.style.left);
      initialY = event.clientY - parseInt(targetTextElement.style.top);
      document.addEventListener('mousemove', drag);
      document.addEventListener('mouseup', endDrag);
    }
    
    // Función para arrastrar el elemento
    function drag(event) {
      const newX = event.clientX - initialX;
      const newY = event.clientY - initialY;
      targetTextElement.style.left = newX + 'px';
      targetTextElement.style.top = newY + 'px';
    }
    
    // Función para finalizar el arrastre
    function endDrag() {
      document.removeEventListener('mousemove', drag);
      document.removeEventListener('mouseup', endDrag);
    }
    
    // Agregar evento de clic al elemento de texto de la multiplicidad del origen
    targetTextElement.addEventListener('mousedown', startDrag);
    // Remover el campo de entrada de texto del destino del documento
    document.body.removeChild(targetMultiplicityInput);
  }
});


  //

  //
  // Remover los campos de entrada de texto al hacer clic fuera de ellos
  document.addEventListener('click', function(e) {
    if (e.target !== sourceMultiplicityInput && e.target !== targetMultiplicityInput) {
      sourceMultiplicityInput.remove();
      targetMultiplicityInput.remove();
    }
  });
  
});



//**********************Guardar y recuperar elementos del paper*********************************************** */
function saveDataToLocalStorage() {
  // Obtener los datos del ClassBox seleccionado
  const classBoxData = {
    x: selectedClassBox.position().x,
    y: selectedClassBox.position().y,
    width: selectedClassBox.size().width,
    height: selectedClassBox.size().height,
    name: selectedClassBox.get('name'),
    attributes: selectedClassBox.get('attributes'),
    methods: selectedClassBox.get('methods')
  };

  
  // Guardar los datos del paper en el localStorage
  localStorage.setItem('paperData', JSON.stringify(paperData));
}

// Función para cargar y mostrar los datos guardados del paper al recargar la página
function loadPaperData() {
  // Verificar si existen datos guardados en el localStorage
  if (localStorage.getItem('paperData')) {
    // Obtener los datos guardados del paper
    const paperData = JSON.parse(localStorage.getItem('paperData'));

    // Restaurar la posición del paper
    paper.setOrigin(paperData.origin.x, paperData.origin.y);
    paper.translate(paperData.translate.x, paperData.translate.y);

    // Restaurar los elementos del paper
    const graph = paper.model;
    const cellsData = paperData.cells;

    // Recorrer los datos de las celdas guardadas y crear los elementos correspondientes
    cellsData.forEach(cellData => {
      const cell = createCell(cellData.type, cellData.position.x, cellData.position.y, cellData.size.width, cellData.size.height);
      graph.addCell(cell);
    });
  }
}

// Evento que se dispara al cargar completamente el contenido HTML de la página
// Obtener una referencia al botón
const saveButton = document.getElementById('save-button');

// Asociar la función savePaperData al evento clic del botón
saveButton.addEventListener('click', saveDataToLocalStorage);

document.addEventListener('DOMContentLoaded', loadPaperData)

//*********************************************************************** */
// Agrega el enlace al grafo de JointJS


// Maneja el evento de clic en el botón para crear una copia
document.getElementById('create-copy-button').addEventListener('click', createCopy);
// Añadir el classBox al lienzo
paper2.model.addCell(classBox);


//************************************************************************ */

/*************************************************************************** */