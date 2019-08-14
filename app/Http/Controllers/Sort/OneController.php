<?php

namespace App\Http\Controllers\Sort;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OneController extends Controller
{


    public function a(){
        $arr = range(10000,99999);
        shuffle($arr);
        array_slice($arr,0,10000);
        srot($arr);
        // for(){

        // }
        //二分法


    }






















//     public static int minNumberInRotateArray(int[] array) {
//         if (array.length == 0)
//             return 0;
//         int left = 0;
//         int right = array.length - 1;
//         int middle = -1;
//         while (array[left]>=array[right]) {
//             if(right-left==1){
//                 middle = right;
//                 break;
//             }
//             middle = left + (right - left) / 2;
//             if (array[middle] >= array[left]) {
//                 left = middle;
//             }
//             if (array[middle] <= array[right]) {
//                 right = middle;
//             }
//         }
//         return array[middle];
//     }
// public class Solution {
//     public int minNumberInRotateArray(int [] array) {
//         if(array.length==0)
        
//             return 0;
            
//         Arrays.sort(array);
        
//         return array[0];
        
    
//     }
// }



// const int MAX_SIZE=20;
//  int main()
//  {
//  	int arrayGossip[MAX_SIZE]; 
// 	arrayGossip[0]=0; /** the first element of array is 0 */
// 	arrayGossip[1]=1;
// 	for(int i=2;i<MAX_SIZE;i++)
// 	{
// 		arrayGossip[i]=arrayGossip[i-1]+arrayGossip[i-2];
// 	}
// 	for(int i=0;i<MAX_SIZE;i++)
// 	{
// 		printf("%d\n",arrayGossip[i]);
// 	}
// 	return 0; 
//  }





}
