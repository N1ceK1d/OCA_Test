def split_into_triplets(array):
    triplets = []

    for i in range(0, len(array), 3):
        triplet = array[i:i + 3]
        triplets.append(triplet)

    return triplets

def max_points(array):
    result_sum = 0
    for array in points:
        result = split_into_triplets(array)
        for triplet in result:
            result_sum += max(triplet)
        print(result_sum)
        result_sum = 0

def min_points(array):
    result_sum = 0
    for array in points:
        result = split_into_triplets(array)
        for triplet in result:
            result_sum += min(triplet)
        print(result_sum)
        result_sum = 0

def min_point(array):
    result_sum = 0
    result = split_into_triplets(array)
    for array_N in result:
        result_sum += min(array_N)
    print(result_sum)
    return result_sum

def max_point(array):
    result_sum = 0
    result = split_into_triplets(array)
    for array_N in result:
        result_sum += max(array_N)
    print(result_sum)
    return result_sum