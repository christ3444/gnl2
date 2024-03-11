@extends('layouts.back-end')

@section('css')
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
  <script src="{{ asset('back_assets/go/release/go.js') }}"></script>

  <script id="code">
    function init() {
      if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
      var $ = go.GraphObject.make;  // for conciseness in defining templates
      myDiagram =
        $(go.Diagram, "genealogyDiagram", // must be the ID or reference to div
          {
            maxSelectionCount: 1, // users can select only one part at a time
            layout:
              $(go.TreeLayout,
                {
                  treeStyle: go.TreeLayout.StyleLastParents,
                  arrangement: go.TreeLayout.ArrangementHorizontal,
                  // properties for most of the tree:
                  angle: 90,
                  layerSpacing: 35,
                  // properties for the "last parents":
                  alternateAngle: 90,
                  alternateLayerSpacing: 35,
                  alternateAlignment: go.TreeLayout.AlignmentBus,
                  alternateNodeSpacing: 20
                }),
            "undoManager.isEnabled": true // enable undo & redo
          });
      // when a node is clicked, add a child to it
      function nodeClick(e, obj) {
        var clicked = obj.part;
        if (clicked !== null) {
          window.location.href = clicked.data.url
        }
      }

      // This function provides a common style for most of the TextBlocks.
      // Some of these values may be overridden in a particular TextBlock.
      function textStyle() {
        return { font: "1rem  Segoe UI,sans-serif", stroke: "black" };
      }
      // This converter is used by the Picture.
      function findHeadShot(icon) {
        return icon;
      }

      function tooltipTextConverter(person) {
        var str = "";
        str += "Nom: " + person.last_name;
        str += "\nPrénom: " + person.first_name;
        str += "\nPays: " + person.pays;
        return str;
      }
      // define tooltips for nodes
      var tooltiptemplate =
        $("ToolTip",
          { "Border.fill": "whitesmoke", "Border.stroke": "black" },
          $(go.TextBlock,
            {
              font: "bold 8pt Helvetica, bold Arial, sans-serif",
              wrap: go.TextBlock.WrapFit,
              margin: 5
            },
            new go.Binding("text", "", tooltipTextConverter))
        );
      // define Converters to be used for Bindings

      // define the Node template
      myDiagram.nodeTemplate =
        $(go.Node, "Auto",
          { click: nodeClick, deletable: false, toolTip: tooltiptemplate },
          // for sorting, have the Node.text be the data.name
          new go.Binding("text", "pseudo"),
          // bind the Part.layerName to control the Node's layer depending on whether it isSelected
          new go.Binding("layerName", "isSelected", function(sel) { return sel ? "Foreground" : ""; }).ofObject(),
          // define the node's outer shape
          $(go.Shape, "Rectangle",
            {
              name: "SHAPE", fill: "white", stroke: null,
              // set the port properties:
              portId: "", fromLinkable: true, toLinkable: true, cursor: "pointer"
            }),
          $(go.Panel, "Vertical",
            $(go.Picture,
              {
                name: "Picture",
                desiredSize: new go.Size(50, 50),
                margin: new go.Margin(6, 6, 6, 6),
              },
              new go.Binding("source", "icon", findHeadShot)),
            // define the Panel where the text will appear
            $(go.TextBlock, textStyle(),
              {
                font: "1rem Segoe UI,sans-serif",
              },
              new go.Binding("text", "pseudo")),
          ) // end Vertical Panel
        );  // end Node
      // define the Link template
      myDiagram.linkTemplate =
        $(go.Link, go.Link.Orthogonal,
          { corner: 2, relinkableFrom: false, relinkableTo: false },
          $(go.Shape, { strokeWidth: 2, stroke: "#00a4a4" }));  // the link shape
      // create the model for the family tree
      // console.log(@json($root_genealogy_data))
      myDiagram.model = new go.TreeModel(@json($root_genealogy_data));
    }

    function goBack() {
      window.history.back()
    }

    $(function() {
      init()
    })

  </script>
@stop

@section('main')
	<div class="page-wrapper">
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 align-self-center">
					<h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Hello {{ Auth::user()->pseudo }}!</h3>
					<div class="d-flex align-items-center">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb m-0 p-0">
								<li class="breadcrumb-item">
                  <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a>
								</li>
                <li class="breadcrumb-item"><a href="#">Réseau</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('network.genealogy', ['user_id' => encrypt(Auth::id())]) }}">Généalogie</a></li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card border-dark">
            <div class="card-header bg-dark d-flex justify-content-between">
              <h3 class="text-white mb-0">Aperçu de la généalogie</h3>
              <button id="back-button" onclick="goBack()" type="button" title="Clickez pour revenir en arrière !" 
                class="btn btn-info">
                <i class="fa fa-arrow-up" style="font-size:24px"></i>
              </button>
            </div>

            <div class="card-body">
              <table class="table mb-4 table-responsive-sm">
                <thead>
                  <tr>
                    <th>Niveau 0</th>
                    <th>Niveau 1</th>
                    <th>Niveau 2</th>
                    <th>Niveau 3</th>
                    <th>Niveau 4</th>
                    <th>Niveau 5</th>
                    <th>Niveau 6</th>
                    <th>Niveau 7</th>
                  </tr>
                </thead>
                <tbody>
                  <td><img src="{{ asset('back_assets/go/level_icones/step_0.jpeg') }}" alt="Step 0 icon" width="50" height="50"></td>
                  <td><img src="{{ asset('back_assets/go/level_icones/step_1.jpeg') }}" alt="Step 1 icon" width="50" height="50"></td>
                  <td><img src="{{ asset('back_assets/go/level_icones/step_2.jpeg') }}" alt="Step 2 icon" width="50" height="50"></td>
                  <td><img src="{{ asset('back_assets/go/level_icones/step_3.jpeg') }}" alt="Step 3 icon" width="50" height="50"></td>
                  <td><img src="{{ asset('back_assets/go/level_icones/step_4.jpeg') }}" alt="Step 4 icon" width="50" height="50"></td>
                  <td><img src="{{ asset('back_assets/go/level_icones/step_5.jpeg') }}" alt="Step 5 icon" width="50" height="50"></td>
                  <td><img src="{{ asset('back_assets/go/level_icones/step_6.jpeg') }}" alt="Step 6 icon" width="50" height="50"></td>
                  <td><img src="{{ asset('back_assets/go/level_icones/step_7.jpeg') }}" alt="Step 6 icon" width="50" height="50"></td>
                </tbody>
              </table>
              <div id="genealogyDiagram" style="width: 100%; height: 500px; background: #f7f7f7"></div>
            </div>
          </div>
        </div>
      </div><!--/.row-->
		</div>
		@include('partials.back-end.footer')
	</div>
@stop
