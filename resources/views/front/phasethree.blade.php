@extends("front.layout")
@section("main")
    <section class="content" style="min-height: 600px">

        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title">{{__("front.subheaderphasethree")}}</h3>
            </div>
            <div class="box-body"  style="min-height: 600px">





                <div class="md:flex flex-col md:flex-row md:min-h-screen w-full max-w-screen-xl mx-auto">
                    <div id="navSide" class="flex flex-col w-full md:w-48 text-gray-700 bg-white flex-shrink-0"></div>
                    <!-- * * * * * * * * * * * * * -->
                    <!-- Start of GoJS sample code -->

                    <script src="../release/go.js"></script>
                    <div id="allSampleContent" class="p-4 w-full">
                        <script id="code">
                            function init() {

                                // Since 2.2 you can also author concise templates with method chaining instead of GraphObject.make
                                // For details, see https://gojs.net/latest/intro/buildingObjects.html
                                const $ = go.GraphObject.make;  // for conciseness in defining templates

                                myDiagram =
                                    new go.Diagram("myDiagramDiv",  // must name or refer to the DIV HTML element
                                        {
                                            grid: $(go.Panel, "Grid",
                                                $(go.Shape, "LineH", { stroke: "lightgray", strokeWidth: 0.5 }),
                                                $(go.Shape, "LineH", { stroke: "gray", strokeWidth: 0.5, interval: 10 }),
                                                $(go.Shape, "LineV", { stroke: "lightgray", strokeWidth: 0.5 }),
                                                $(go.Shape, "LineV", { stroke: "gray", strokeWidth: 0.5, interval: 10 })
                                            ),
                                            "draggingTool.dragsLink": true,
                                            "draggingTool.isGridSnapEnabled": true,
                                            "linkingTool.isUnconnectedLinkValid": true,
                                            "linkingTool.portGravity": 20,
                                            "relinkingTool.isUnconnectedLinkValid": true,
                                            "relinkingTool.portGravity": 20,
                                            "relinkingTool.fromHandleArchetype":
                                                $(go.Shape, "Diamond", { segmentIndex: 0, cursor: "pointer", desiredSize: new go.Size(8, 8), fill: "tomato", stroke: "darkred" }),
                                            "relinkingTool.toHandleArchetype":
                                                $(go.Shape, "Diamond", { segmentIndex: -1, cursor: "pointer", desiredSize: new go.Size(8, 8), fill: "darkred", stroke: "tomato" }),
                                            "linkReshapingTool.handleArchetype":
                                                $(go.Shape, "Diamond", { desiredSize: new go.Size(7, 7), fill: "lightblue", stroke: "deepskyblue" }),
                                            "rotatingTool.handleAngle": 270,
                                            "rotatingTool.handleDistance": 30,
                                            "rotatingTool.snapAngleMultiple": 15,
                                            "rotatingTool.snapAngleEpsilon": 15,
                                            "undoManager.isEnabled": true
                                        });
// Step 1: Define the Custom Figure
                                go.Shape.defineFigureGenerator("Computer", function(shape, w, h) {
                                    var geo = new go.Geometry();
                                    var fig = new go.PathFigure(0, h * 0.2, true); // Start at the top left of the monitor
                                    geo.add(fig);

                                    // Monitor
                                    fig.add(new go.PathSegment(go.PathSegment.Line, w, h * 0.2)); // Top line of monitor
                                    fig.add(new go.PathSegment(go.PathSegment.Line, w, h * 0.8)); // Right side of monitor
                                    fig.add(new go.PathSegment(go.PathSegment.Line, 0, h * 0.8).close()); // Bottom line of monitor

                                    // Base of the computer
                                    var fig2 = new go.PathFigure(w * 0.45, h * 0.8, false); // Non-filled path for the base
                                    geo.add(fig2);
                                    fig2.add(new go.PathSegment(go.PathSegment.Line, w * 0.55, h * 0.8));
                                    fig2.add(new go.PathSegment(go.PathSegment.Line, w * 0.5, h));
                                    fig2.add(new go.PathSegment(go.PathSegment.Line, w * 0.45, h * 0.8));

                                    // Optionally, add more details (like a keyboard or screen content)

                                    return geo;
                                });

// Step 2: Update the Palette Model


                                // when the document is modified, add a "*" to the title and enable the "Save" button
                                myDiagram.addDiagramListener("Modified", e => {
                                    var button = document.getElementById("SaveButton");
                                    if (button) button.disabled = !myDiagram.isModified;
                                    var idx = document.title.indexOf("*");
                                    if (myDiagram.isModified) {
                                        if (idx < 0) document.title += "*";
                                    } else {
                                        if (idx >= 0) document.title = document.title.slice(0, idx);
                                    }
                                });

                                // Define a function for creating a "port" that is normally transparent.
                                // The "name" is used as the GraphObject.portId, the "spot" is used to control how links connect
                                // and where the port is positioned on the node, and the boolean "output" and "input" arguments
                                // control whether the user can draw links from or to the port.
                                function makePort(name, spot, output, input) {
                                    // the port is basically just a small transparent circle
                                    return $(go.Shape, "Circle",
                                        {
                                            fill: null,  // not seen, by default; set to a translucent gray by showSmallPorts, defined below
                                            stroke: null,
                                            desiredSize: new go.Size(7, 7),
                                            alignment: spot,  // align the port on the main Shape
                                            alignmentFocus: spot,  // just inside the Shape
                                            portId: name,  // declare this object to be a "port"
                                            fromSpot: spot, toSpot: spot,  // declare where links may connect at this port
                                            fromLinkable: output, toLinkable: input,  // declare whether the user may draw links to/from here
                                            cursor: "pointer"  // show a different cursor to indicate potential link point
                                        });
                                }

                                var nodeSelectionAdornmentTemplate =
                                    $(go.Adornment, "Auto",
                                        $(go.Shape, { fill: null, stroke: "deepskyblue", strokeWidth: 1.5, strokeDashArray: [4, 2] }),
                                        $(go.Placeholder)
                                    );

                                var nodeResizeAdornmentTemplate =
                                    $(go.Adornment, "Spot",
                                        { locationSpot: go.Spot.Right },
                                        $(go.Placeholder),
                                        $(go.Shape, { alignment: go.Spot.TopLeft, cursor: "nw-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
                                        $(go.Shape, { alignment: go.Spot.Top, cursor: "n-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
                                        $(go.Shape, { alignment: go.Spot.TopRight, cursor: "ne-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),

                                        $(go.Shape, { alignment: go.Spot.Left, cursor: "w-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
                                        $(go.Shape, { alignment: go.Spot.Right, cursor: "e-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),

                                        $(go.Shape, { alignment: go.Spot.BottomLeft, cursor: "se-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
                                        $(go.Shape, { alignment: go.Spot.Bottom, cursor: "s-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" }),
                                        $(go.Shape, { alignment: go.Spot.BottomRight, cursor: "sw-resize", desiredSize: new go.Size(6, 6), fill: "lightblue", stroke: "deepskyblue" })
                                    );

                                var nodeRotateAdornmentTemplate =
                                    $(go.Adornment,
                                        { locationSpot: go.Spot.Center, locationObjectName: "ELLIPSE" },
                                        $(go.Shape, "Ellipse", { name: "ELLIPSE", cursor: "pointer", desiredSize: new go.Size(7, 7), fill: "lightblue", stroke: "deepskyblue" }),
                                        $(go.Shape, { geometryString: "M3.5 7 L3.5 30", isGeometryPositioned: true, stroke: "deepskyblue", strokeWidth: 1.5, strokeDashArray: [4, 2] })
                                    );

                                myDiagram.nodeTemplate =
                                    $(go.Node, "Spot",
                                        { locationSpot: go.Spot.Center },
                                        new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
                                        { selectable: true, selectionAdornmentTemplate: nodeSelectionAdornmentTemplate },
                                        { resizable: true, resizeObjectName: "PANEL", resizeAdornmentTemplate: nodeResizeAdornmentTemplate },
                                        { rotatable: true, rotateAdornmentTemplate: nodeRotateAdornmentTemplate },
                                        new go.Binding("angle").makeTwoWay(),
                                        // the main object is a Panel that surrounds a TextBlock with a Shape
                                        $(go.Panel, "Auto",
                                            { name: "PANEL" },
                                            new go.Binding("desiredSize", "size", go.Size.parse).makeTwoWay(go.Size.stringify),
                                            $(go.Shape, "Rectangle",  // default figure
                                                {
                                                    portId: "", // the default port: if no spot on link data, use closest side
                                                    fromLinkable: true, toLinkable: true, cursor: "pointer",
                                                    fill: "white",  // default color
                                                    strokeWidth: 2
                                                },
                                                new go.Binding("figure"),
                                                new go.Binding("fill")),
                                            $(go.TextBlock,
                                                {
                                                    font: "bold 10pt Helvetica, Arial, sans-serif",
                                                    margin: 8,
                                                    maxSize: new go.Size(160, NaN),
                                                    wrap: go.TextBlock.WrapFit,
                                                    editable: true
                                                },
                                                new go.Binding("text").makeTwoWay())
                                        ),
                                        // four small named ports, one on each side:
                                        makePort("T", go.Spot.Top, false, true),
                                        makePort("L", go.Spot.Left, true, true),
                                        makePort("R", go.Spot.Right, true, true),
                                        makePort("B", go.Spot.Bottom, true, false),
                                        { // handle mouse enter/leave events to show/hide the ports
                                            mouseEnter: (e, node) => showSmallPorts(node, true),
                                            mouseLeave: (e, node) => showSmallPorts(node, false)
                                        }
                                    );

                                function showSmallPorts(node, show) {
                                    node.ports.each(port => {
                                        if (port.portId !== "") {  // don't change the default port, which is the big shape
                                            port.fill = show ? "rgba(0,0,0,.3)" : null;
                                        }
                                    });
                                }

                                var linkSelectionAdornmentTemplate =
                                    $(go.Adornment, "Link",
                                        $(go.Shape,
                                            // isPanelMain declares that this Shape shares the Link.geometry
                                            { isPanelMain: true, fill: null, stroke: "deepskyblue", strokeWidth: 0 })  // use selection object's strokeWidth
                                    );

                                myDiagram.linkTemplate =
                                    $(go.Link,  // the whole link panel
                                        { selectable: true, selectionAdornmentTemplate: linkSelectionAdornmentTemplate },
                                        { relinkableFrom: true, relinkableTo: true, reshapable: true },
                                        {
                                            routing: go.Link.AvoidsNodes,
                                            curve: go.Link.JumpOver,
                                            corner: 5,
                                            toShortLength: 4
                                        },
                                        new go.Binding("points").makeTwoWay(),
                                        $(go.Shape,  // the link path shape
                                            { isPanelMain: true, strokeWidth: 2 }),
                                        $(go.Shape,  // the arrowhead
                                            { toArrow: "Standard", stroke: null }),
                                        $(go.Panel, "Auto",
                                            new go.Binding("visible", "isSelected").ofObject(),
                                            $(go.Shape, "RoundedRectangle",  // the link shape
                                                { fill: "#F8F8F8", stroke: null }),
                                            $(go.TextBlock,
                                                {
                                                    textAlign: "center",
                                                    font: "10pt helvetica, arial, sans-serif",
                                                    stroke: "#919191",
                                                    margin: 2,
                                                    minSize: new go.Size(10, NaN),
                                                    editable: true
                                                },
                                                new go.Binding("text").makeTwoWay())
                                        )
                                    );

                                load();  // load an initial diagram from some JSON text

                                // initialize the Palette that is on the left side of the page
                                myPalette =
                                    new go.Palette("myPaletteDiv",  // must name or refer to the DIV HTML element
                                        {
                                            maxSelectionCount: 1,
                                            nodeTemplateMap: myDiagram.nodeTemplateMap,  // share the templates used by myDiagram
                                            linkTemplate: // simplify the link template, just in this Palette
                                                $(go.Link,
                                                    { // because the GridLayout.alignment is Location and the nodes have locationSpot == Spot.Center,
                                                        // to line up the Link in the same manner we have to pretend the Link has the same location spot
                                                        locationSpot: go.Spot.Center,
                                                        selectionAdornmentTemplate:
                                                            $(go.Adornment, "Link",
                                                                { locationSpot: go.Spot.Center },
                                                                $(go.Shape,
                                                                    { isPanelMain: true, fill: null, stroke: "deepskyblue", strokeWidth: 0 }),
                                                                $(go.Shape,  // the arrowhead
                                                                    { toArrow: "Standard", stroke: null })
                                                            )
                                                    },
                                                    {
                                                        routing: go.Link.AvoidsNodes,
                                                        curve: go.Link.JumpOver,
                                                        corner: 5,
                                                        toShortLength: 4
                                                    },
                                                    new go.Binding("points"),
                                                    $(go.Shape,  // the link path shape
                                                        { isPanelMain: true, strokeWidth: 2 }),
                                                    $(go.Shape,  // the arrowhead
                                                        { toArrow: "Standard", stroke: null })
                                                ),
                                            model: new go.GraphLinksModel([  // specify the contents of the Palette


                                                {text: "Node", figure: "Computer", fill: "#2E7D32", size: "100 100"},

                                                { text: "Smart Contract", figure: "RoundedRectangle", fill: "lightyellow" }
                                            ], [
                                                // the Palette also has a disconnected Link, which the user can drag-and-drop
                                                { points: new go.List(/*go.Point*/).addAll([new go.Point(0, 0), new go.Point(30, 0), new go.Point(30, 40), new go.Point(60, 40)]) }
                                            ])
                                        });
                            }


                            // Show the diagram's model in JSON format that the user may edit
                            function save() {
                                saveDiagramProperties();  // do this first, before writing to JSON
                                document.getElementById("mySavedModel").value = myDiagram.model.toJson();
                                myDiagram.isModified = false;
                            }
                            function load() {
                                myDiagram.model = go.Model.fromJson(document.getElementById("mySavedModel").value);
                                loadDiagramProperties();  // do this after the Model.modelData has been brought into memory
                            }

                            function saveDiagramProperties() {
                                myDiagram.model.modelData.position = go.Point.stringify(myDiagram.position);
                            }
                            function loadDiagramProperties(e) {
                                // set Diagram.initialPosition, not Diagram.position, to handle initialization side-effects
                                var pos = myDiagram.model.modelData.position;
                                if (pos) myDiagram.initialPosition = go.Point.parse(pos);
                            }
                            window.addEventListener('DOMContentLoaded', init);

                        </script>
                        <div id="sample">
                            <div style="width: 100%; display: flex; justify-content: space-between">
                                <div id="myPaletteDiv" style="width: 200px; margin-right: 2px; background-color: whitesmoke; border: solid 1px black"></div>
                                <div id="myDiagramDiv" style="flex-grow: 1; height: 620px; border: solid 1px black"></div>
                            </div>

                            <div>
                                <div>
                                    <button id="SaveButton" onclick="save()">Save</button>
                                    <button onclick="load()">Load</button>
                                    Diagram Model saved in JSON format:
                                </div>
                                <textarea id="mySavedModel" style="width:100%;height:300px">
{ "class": "go.GraphLinksModel",
  "linkFromPortIdProperty": "fromPort",
  "linkToPortIdProperty": "toPort",
  "nodeDataArray": [
 ],
  "linkDataArray": [
 ]}
    </textarea>



                <!--  This script is part of the gojs.net website, and is not needed to run the sample -->
                <script src="https://unpkg.com/gojs@2.2.7/release/go.js"></script>







            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection



