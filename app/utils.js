function sortContacts() {
			  var lis = $('.contacts').children();
			  var vals = [];
				
			  // Populate the array
			  for(var i = 0, l = lis.length; i < l; i++)
				vals.push(lis[i].innerHTML);

			  // Sort it
			  vals.sort();

			  // Change the list on the page
			  for(var i = 0; i < lis.length; i++)
				lis[i].innerHTML = vals[i]; 
			}
						
			function add(toAdd){
				var x = $(toAdd).clone();
				$(toAdd).remove(); // Hide it
				$(x).attr("onclick", "remove(this)");
				$('.addedList').append(x); // Add it to the second list
				 $('.contacts').listview('refresh');
				 $('.addedList').listview('refresh');
			}
			
			function remove(toRemove){
				
				var x = $(toRemove).clone();
				$(toRemove).remove(); // Hide it
				$(x).attr("onclick", "add(this)");
				$('.contacts').append(x); // Add it to the first list
				//sortContacts();
				 $('.addedList').listview('refresh');
				 $('.contacts').listview('refresh');
			}